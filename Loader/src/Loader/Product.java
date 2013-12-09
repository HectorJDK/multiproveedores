package Loader;

public class Product extends Tuple
{
    static int productsCounter = 0;

    private Type type;
    private final String manuacturer_id;
    private final boolean generic;
    public final boolean deleted;

    private String[] attributes_values;

    public Product()
    {
        Object[] line = Loader.readFormatted(Loader.TypesForCast.STRING, Loader.TypesForCast.STRING, Loader.TypesForCast.BOOLEAN, Loader.TypesForCast.BOOLEAN);
        this.type = Loader.getTypeForName((String) line[0]);
        this.manuacturer_id = (String) line[1];
        this.generic = (Boolean) line[2];
        this.deleted = (Boolean) line[3];

        attributes_values = new String[this.type.getNumberOfAttributes()];
        for(int i = 0; i < attributes_values.length; i++)
        {
            attributes_values[i] = Loader.readString();
        }
    }

    public String getManufacturerId()
    {
        return this.manuacturer_id;
    }

    @Override
    public int getNextId()
    {
        productsCounter++;
        return productsCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]
            {
                "id", "type_id", "manufacturer_id", "generic", "deleted"
            };
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]
                {
                        this.id, this.type.id, this.manuacturer_id, this.generic, this.deleted
                };
    }

    @Override
    public String getTableName()
    {
        return "products";
    }
}
