package Loader;

public class DataType extends Tuple
{
    static int dataTypeCounter = 0;

    String name;

    public DataType(String name)
    {
        this.name = name;
    }

    @Override
    public int getNextId()
    {
        dataTypeCounter++;
        return dataTypeCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "name"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{this.getId(), this.name};
    }

    @Override
    public String getTableName()
    {
        return "data_types";
    }

}
