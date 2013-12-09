package Loader;

public class Type extends Tuple
{
    static int typesCounter = 0;

    String name;
    boolean deleted;
    Attribute[] attributes;

    public Type()
    {
        Object[] line = Loader.readFormatted(Loader.TypesForCast.STRING, Loader.TypesForCast.BOOLEAN);
        this.name = (String) line[0];
        this.deleted = (Boolean) line[1];

        this.attributes = Loader.readAttributes(this);
    }

    public int getNumberOfAttributes()
    {
        return this.attributes.length;
    }

    @Override
    public int getNextId()
    {
        typesCounter++;
        return typesCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]
                {
                        "id", "type_name", "deleted"
                };
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]
                {
                        this.id, this.name, this.deleted
                };
    }

    @Override
    public String getTableName()
    {
        return "types";
    }
}
