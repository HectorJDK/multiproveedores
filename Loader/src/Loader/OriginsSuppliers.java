package Loader;

public class OriginsSuppliers extends Tuple
{
    static int origins_suppliers_counter = 0;
    Origin origin;
    Supplier supplier;

    public OriginsSuppliers(Origin o, Supplier s)
    {
        this.origin = o;
        this.supplier = s;
    }

    @Override
    public int getNextId()
    {
        origins_suppliers_counter ++;
        return origins_suppliers_counter;
    }

    @Override
    public String[] getColumnsNames()
    {
        return new String[]{"id", "origin_id", "supplier_id", "deleted_origin", "deleted_supplier"};
    }

    @Override
    public Object[] getColumnsValues()
    {
        return new Object[]{this.getId(), this.origin.getId(), this.supplier.getId(), this.origin.deleted, this.supplier.deleted};
    }

    @Override
    public String getTableName()
    {
        return "origins_suppliers";
    }
}
