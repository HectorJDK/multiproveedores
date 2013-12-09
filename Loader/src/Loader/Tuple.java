package Loader;

public abstract class Tuple
{
    int id;

    public Tuple()
    {
        this.id = this.getNextId();
    }

    public int getId()
    {
        return id;
    }

    public String insertSQL()
    {
        String[] placeholders = new String[this.getColumnsValues().length];
        for(int i = 0; i < placeholders.length; i++)
        {
            placeholders[i] = "?";
        }
        return String.format(
                    "INSERT INTO %s (%s) VALUES (%s)",
                    this.getTableName(),
                    Utils.joinStringsWithCommas(this.getColumnsNames()),
                    Utils.joinStringsWithCommas(placeholders)
                );
    }

    public Object[] getValuesToInsert()
    {
        return this.getColumnsValues();
    }

    public abstract int getNextId();
    public abstract String[] getColumnsNames();
    public abstract Object[] getColumnsValues();
    public abstract String getTableName();
}
