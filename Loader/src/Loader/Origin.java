package Loader;

public class Origin extends Tuple
{
    static int originsCounter = 0;

    String URL;
    boolean deleted;

    public Origin()
    {
        Object[] line = Loader.readFormatted(Loader.TypesForCast.STRING, Loader.TypesForCast.BOOLEAN);
        this.URL = (String) line[0];
        this.deleted = (Boolean) line[1];
    }

    public String getURL()
    {
        return this.URL;
    }

    @Override
    public int getNextId()
    {
        originsCounter ++;
        return originsCounter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "url", "deleted"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]
                {
                        this.getId(), this.getURL(), this.deleted
                };
    }

    @Override
    public String getTableName()
    {
        return "origins";
    }
}
