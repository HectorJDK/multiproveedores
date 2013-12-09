package Loader;

public class Equivalency extends Tuple
{
    static int equivalenciesCounter = 0;

    Product original;
    Product equivalency;

    public Equivalency(Product original, Product equivalent)
    {
        this.original = original;
        this.equivalency = equivalent;
    }

    public Equivalency()
    {
        Object[] line = Loader.readFormatted(Loader.TypesForCast.STRING, Loader.TypesForCast.STRING);
        this.original = Loader.getProductForManufacturerId((String) line[0]);
        this.equivalency = Loader.getProductForManufacturerId((String) line[1]);
    }

    @Override
    public int getNextId()
    {
        equivalenciesCounter ++;
        return equivalenciesCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "original_id", "equivalent_id", "deleted_original", "deleted_equivalent" };
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{
                this.getId(),
                original.getId(),
                equivalency.getId(),
                original.deleted,
                equivalency.deleted};
    }

    @Override
    public String getTableName()
    {
        return "equivalency_relations";
    }

    public Product getOriginal()
    {
        return this.original;
    }

    public Product getEquivalency()
    {
        return this.equivalency;
    }
}
