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
                    Advance Shipping Notice
                    <i class="right fas fa-angle-left"></i>
                </p>
            </a>
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="<?= site_url('inbound/create_asn') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>Add ASN</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="<?= site_url('inbound/asn') ?>" class="nav-link">
                        <i class="far fa-dot-circle nav-icon"></i>
                        <p>List ASN</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</li>