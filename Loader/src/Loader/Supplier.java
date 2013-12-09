package Loader;

public class Supplier extends Tuple
{
    static int suppliersCounter = 0;

    String corporate_name;
    String moral_rfc;
    String contact_name;
    String contact_email;
    String contact_telephone;
    int rating;
    int accepted_quotes;
    int rejected_quotes;
    double payed;
    double debt;
    boolean credit;
    boolean deleted;

    Origin[] origins;
    Type[] productTypes;

    OriginsSuppliers[] origins_suppliers;
    SuppliersTypes[] suppliers_types;

    public Supplier()
    {
        Object[] line = Loader.readFormatted(
                Loader.TypesForCast.STRING,
                Loader.TypesForCast.STRING,
                Loader.TypesForCast.STRING,
                Loader.TypesForCast.STRING,
                Loader.TypesForCast.STRING,
                Loader.TypesForCast.INTEGER,
                Loader.TypesForCast.INTEGER,
                Loader.TypesForCast.INTEGER,
                Loader.TypesForCast.DOUBLE,
                Loader.TypesForCast.DOUBLE,
                Loader.TypesForCast.BOOLEAN,
                Loader.TypesForCast.BOOLEAN
        );
        this.corporate_name = (String) line[0];
        this.moral_rfc = (String) line[1];
        this.contact_name = (String) line[2];
        this.contact_email = (String) line[3];
        this.contact_telephone = (String) line[4];

        this.rating = (Integer) line[5];
        this.accepted_quotes = (Integer) line[6];
        this.rejected_quotes = (Integer) line[7];

        this.payed = (Double) line[8];
        this.debt = (Double) line[9];

        this.credit = (Boolean) line[10];
        this.deleted = (Boolean) line[11];


        //origins
        int numberOfOrigins = Loader.readInt();
        this.origins = new Origin[numberOfOrigins];
        for(int i = 0; i < numberOfOrigins; i++)
        {
            this.origins[i] = Loader.getOriginForURL(Loader.readString());
        }
        this.origins_suppliers = new OriginsSuppliers[this.origins.length];
        for(int i = 0; i < origins_suppliers.length; i++)
        {
            this.origins_suppliers[i] = new OriginsSuppliers(this.origins[i], this);
        }


        // types
        int numberOfTypes = Loader.readInt();
        this.productTypes = new Type[numberOfTypes];
        for(int i = 0; i < numberOfTypes; i++)
        {
            this.productTypes[i] = Loader.getTypeForName(Loader.readString());
        }
        this.suppliers_types = new SuppliersTypes[this.productTypes.length];
        for(int i = 0; i < suppliers_types.length; i++)
        {
            this.suppliers_types[i] = new SuppliersTypes(this, this.productTypes[i]);
        }
    }

    @Override
    public int getNextId()
    {
        suppliersCounter ++;
        return suppliersCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]
                {
                        "id", "corporate_name", "moral_rfc",
                        "contact_name", "contact_email", "contact_telephone",
                        "rating", "accepted_quotes", "rejected_quotes", "deleted",
                        "payed", "debt", "credit"
                };
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]
                {
                        this.id, this.corporate_name, this.moral_rfc,
                        this.contact_name, this.contact_email, this.contact_telephone,
                        this.rating, this.accepted_quotes, this.rejected_quotes,
                        this.deleted, this.payed, this.debt, this.credit
                };
    }

    @Override
    public String getTableName()
    {
        return "suppliers";
    }
}
