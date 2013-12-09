package Loader;

public class Attribute extends Tuple
{
    static int attributeCounter = 0;

    String name;
    DataType dataType;

    Type type;

    public Attribute(Type type)
    {
        Object[] line = Loader.readFormatted(Loader.TypesForCast.STRING, Loader.TypesForCast.STRING);
        this.name = (String) line[0];
        this.dataType = Loader.getDataTypeForName((String)line[1]);

        this.type = type;
    }

    @Override
    public int getNextId()
    {
        attributeCounter++;
        return attributeCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "name", "type_id", "data_type_id"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{
                this.getId(),
                this.name,
                this.type.getId(),
                this.dataType.getId()
        };
    }

    @Override
    public String getTableName()
    {
        return "attributes";
    }
}
