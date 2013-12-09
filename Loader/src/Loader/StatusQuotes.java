package Loader;

public class StatusQuotes extends Tuple
{
    static int status_quotes_counter = 0;

    String value;

    public StatusQuotes(String value)
    {
        this.value = value;
    }

    @Override
    public int getNextId()
    {
        status_quotes_counter ++;
        return status_quotes_counter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "value"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{this.getId(), this.value};
    }

    @Override
    public String getTableName()
    {
        return "status_quotes";
    }
}
