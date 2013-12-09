package Loader;

import java.io.File;
import java.io.FileNotFoundException;
import java.sql.*;
import java.util.Scanner;

public class Loader
{
    static Scanner scanner = null;

    static DataType[] dataTypes;
    static StatusQuotes[] statusQuotes;

    static Type[] types;
    static Product[] products;
    static Equivalency[] equivalencies;
    static Origin[] origins;
    static Supplier[] suppliers;

    static Connection connection;

    static enum TypesForCast
    {
        STRING, INTEGER, BOOLEAN, DOUBLE
    };

    public static void main(String[] args) throws ClassNotFoundException, SQLException {
        createDataTypes();
        createStatusQuotes();
        read(args);
        connect();
        clear();
        insert();
        System.out.println("Listo!");
    }

    private static void createDataTypes()
    {
        dataTypes = new DataType[] {
                new DataType("Entero"),
                new DataType("Decimal"),
                new DataType("Texto"),
                new DataType("Fecha") };
    }

    private static void createStatusQuotes()
    {
        statusQuotes = new StatusQuotes[]{
                new StatusQuotes("aceptado"),
                new StatusQuotes("precio"),
                new StatusQuotes("existencia"),
                new StatusQuotes("respuesta"),
                new StatusQuotes("tiempo")
        };
    }

    public static void read(String[] args)
    {
        String fileName;
        if(args.length == 1)
        {
            fileName = args[0];
        }
        else
        {
            System.out.println("Introduce el nombre de un archivo");
            Scanner stdin = new Scanner(System.in);
            fileName = stdin.nextLine();
        }

        try {
            scanner = new Scanner(new File(fileName));
        } catch (FileNotFoundException e)
        {
            System.err.println("Hubo un problema al leer el archivo.");
            System.exit(-1);
        }

        types = readTypes();
        products = readProducts();
        equivalencies = readEquivalencies();
        origins = readOrigins();
        suppliers = readSuppliers();
        System.out.println("Parse correcto.");
    }

    public static void connect() throws ClassNotFoundException {
        Scanner s = new Scanner(System.in);

        System.out.println("Introduzca el host:");
        String host = s.nextLine();

        System.out.println("Introduzca el puerto:");
        String port = s.nextLine();

        System.out.println("Introduzca el nombre de la base de datos:");
        String database = s.nextLine();

        System.out.println("Introduzca el usuario:");
        String user = s.nextLine();

        System.out.println("Introduzca la contraseña:");
        String password = s.nextLine();

        Class.forName("org.postgresql.Driver");

        try {

            connection = DriverManager.getConnection(
                    String.format("jdbc:postgresql://%s:%s/%s", host, port, database),
                    user,
                    password);

        } catch (SQLException e) {

            System.out.println("Connection Failed! Check output console");
            e.printStackTrace();
            System.exit(-1);

        }
    }

    public static void clear()
    {
        String[] tables = new String[]{"attributes", "attributes_products", "contents", "data_types", "emails",
                "equivalency_relations", "orders", "origins", "origins_suppliers", "products", "products_suppliers",
                "quotes", "requests", "status_quotes", "suppliers", "suppliers_types", "types", "users"
        };

        String sql = String.format("TRUNCATE TABLE %s CASCADE", Utils.joinStringsWithCommas(tables));
        try
        {
            connection.createStatement().execute(sql);
        } catch (SQLException e)
        {
            e.printStackTrace();
        }
    }

    public static void insert() throws SQLException {
        Tuple[][] tables = new Tuple[][]{dataTypes, statusQuotes, types, products, equivalencies, origins, suppliers};

        for(Tuple[] table : tables)
        {
            insertTable(table);
        }

        for(Supplier s : suppliers)
        {
            insertTable(s.origins_suppliers);
            insertTable(s.suppliers_types);
        }
    }

    public static void insertTable(Tuple[] tuples) throws SQLException {
        for(Tuple tuple : tuples)
        {
            prepareStatementWithValues(connection.prepareStatement(tuple.insertSQL()), tuple.getValuesToInsert()).execute();
        }
    }

    private static PreparedStatement prepareStatementWithValues(PreparedStatement ps, Object[] values) throws SQLException {
        for(int i = 0; i < values.length; i++)
        {
            Object o = values[i];
            Class c = o.getClass();
            if(c == Integer.class)
            {
                ps.setInt(i + 1, (Integer) o);
            }
            else if(c == Boolean.class)
            {
                ps.setBoolean(i + 1, (Boolean) o);
            }
            else if(c == Double.class)
            {
                ps.setDouble(i + 1, (Double) o);
            }
            else if(c == Float.class)
            {
                ps.setFloat(i + 1, (Float) o);
            }
            else if(c == String.class)
            {
                ps.setString(i + 1, (String) o);
            }
            else
            {
                System.out.println("Didn't consider: " + c);
                System.exit(-1);
            }
        }
        return ps;
    }

    public static Type[] readTypes()
    {
        int numberOfTypes = readInt();
        Type[] types = new Type[numberOfTypes];
        for(int i = 0; i < numberOfTypes; i++)
        {
            types[i] = new Type();
        }
        return types;
    }

    public static Attribute[] readAttributes(Type newType)
    {
        int numberOfAttributes =  readInt();
        Attribute[] atts = new Attribute[numberOfAttributes];
        for(int i = 0; i < numberOfAttributes; i++)
        {
            atts[i] = new Attribute(newType);
        }
        return atts;
    }

    public static Product[] readProducts()
    {
        int numberOfProducts = readInt();
        Product[] products = new Product[numberOfProducts];
        for(int i = 0; i < numberOfProducts; i++)
        {
            products[i] = new Product();
        }
        return products;
    }

    public static Equivalency[] readEquivalencies()
    {
        int numberOfEquivalencies = readInt();
        Equivalency[] equivalencies = new Equivalency[numberOfEquivalencies + products.length];
        for(int i = 0; i < products.length; i++)
        {
            equivalencies[i] = new Equivalency(products[i], products[i]);
        }
        for(int i = 0; i < numberOfEquivalencies; i++)
        {
            equivalencies[i + products.length] = new Equivalency();
        }
        return equivalencies;
    }

    public static Origin[] readOrigins()
    {
        int numberOfOrigins = readInt();
        Origin[] origins = new Origin[numberOfOrigins];
        for(int i = 0; i < numberOfOrigins; i++)
        {
            origins[i] = new Origin();
        }
        return origins;
    }

    public static Supplier[] readSuppliers()
    {
        int numberOfSuppliers = readInt();
        Supplier[] suppliers = new Supplier[numberOfSuppliers];
        for(int i = 0; i < numberOfSuppliers; i++)
        {
            suppliers[i] = new Supplier();
        }
        return suppliers;
    }

    public static String readString()
    {
        return scanner.nextLine().split("\t")[0];
    }

    public static int readInt()
    {
        return Integer.parseInt(scanner.nextLine().split("\t")[0]);
    }

    public static boolean readBoolean()
    {
        return scanner.nextLine().split("\t")[0].equalsIgnoreCase("true");
    }

    public static Type getTypeForName(String typeName)
    {
        for(Type t : types)
        {
             if(t.name.equalsIgnoreCase(typeName))
                 return t;
        }
        exitWithErrorMessage("Se usó un tipo de producto no definido: " + typeName);
        return null;
    }

    public static DataType getDataTypeForName(String dataTypeName)
    {
        for(DataType dt : dataTypes)
        {
            if(dt.name.equalsIgnoreCase(dataTypeName))
                return dt;
        }
        exitWithErrorMessage("Se usó un tipo de dato no definido: " + dataTypeName);
        return null;
    }

    public static Product getProductForManufacturerId(String manufacturerId)
    {
        for(Product p : products)
        {
            if(p.getManufacturerId().equalsIgnoreCase(manufacturerId))
                return p;
        }
        exitWithErrorMessage("Se usó un producto no definido: " + manufacturerId);
        return null;
    }

    public static Origin getOriginForURL(String URL)
    {
        for(Origin o : origins)
        {
            if(o.getURL().equalsIgnoreCase(URL))
                return o;
        }
        exitWithErrorMessage("Se usó un origen no definido: " + URL);
        return null;
    }

    public static Object[] readFormatted(TypesForCast... formats)
    {
        Object[] formattedLine = new Object[formats.length];
        String[] line = scanner.nextLine().split("\t");
        for(int i = 0; i < formats.length; i++)
        {
            Object aux;
            switch (formats[i])
            {
                case STRING:
                    aux = line[i];
                    break;
                case INTEGER:
                    aux = Integer.parseInt(line[i]);
                    break;
                case BOOLEAN:
                    aux = new Boolean(line[i].equalsIgnoreCase("true"));
                    break;
                case DOUBLE:
                    aux = Double.parseDouble(line[i]);
                    break;
                default:
                    aux = null;
                    break;
            }
            formattedLine[i] = aux;
        }
        return formattedLine;
    }

    public static void exitWithErrorMessage(String errorMessage)
    {
        throw new Error(errorMessage);
    }
}