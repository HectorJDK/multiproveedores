package Loader;

public class SuppliersTypes extends Tuple
{
    static int suppliers_types_counter = 0;

    Supplier supplier;
    Type type;

    public SuppliersTypes(Supplier s, Type t)
    {
        this.supplier = s;
        this.type = t;
    }

    @Override
    public int getNextId()
    {
        suppliers_types_counter ++;
        return suppliers_types_counter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "supplier_id", "type_id", "deleted_supplier", "deleted_type"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{this.getId(), this.supplier.getId(), this.type.getId(), this.supplier.deleted, this.type.deleted};
    }

    @Override
    public String getTableName()
    {
        return "suppliers_types";
    }
}
