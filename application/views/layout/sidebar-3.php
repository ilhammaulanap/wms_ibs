<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Master Data
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item">
            <a href="<?= site_url('supplier') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Supplier</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('mot') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>MOT</p>
            </a>
        </li>
        <li class="nav-item">
            <a href="<?= site_url('vendors') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Vendor</p>
            </a>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Warehouse
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('warehouse/locator/' . md5($this->session->userdata('wh_id_warehouse'))) ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Manage Locator</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Product
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>

            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('product/uom') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Manage Unit Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('product/category') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Manage Product Group Code</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('product') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Manage Product</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>
<li class="nav-item has-treeview">
    <a href="#" class="nav-link">
        <i class="nav-icon fas fa-copy"></i>
        <p>
            Transaction Data
            <i class="right fas fa-angle-left"></i>
        </p>
    </a>
    <ul class="nav nav-treeview">
        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Inbound
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('inbound/create') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Add Inbound</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('inbound/receive_stock_transfer') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Receive Stock Transfer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('inbound') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>List Inbound</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('inbound/history') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>History Inbound</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Outbound
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('outbound/order/add') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Add Outbound</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('outbound') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>List Outbound</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('outbound/history') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>History Outbound</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Stock Transfer
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('stocktransfer/add') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Add Stock Transfer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('stocktransfer') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>List Stock Transfer</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('stocktransfer/history') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>History Stock Transfer</p>
                    </a>
                </li>
            </ul>
        </li>

        <li class="nav-item">
            <a href="<?= site_url('product/inventory') ?>" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>Inventory</p>
            </a>
        </li>

        <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
                <i class="far fa-circle nav-icon"></i>
                <p>
                    Cycle Count
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('cyclecount/create') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Add Cyclce Count</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('cyclecount/list') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>List Cyclce Count</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>