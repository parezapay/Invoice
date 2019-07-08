


<div class="sidebar hidden-xs">
    <ul id="accordion">
    	<li ><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Pareza_Invoice_Logo.png"></li>
        <li >
            <a class="active" href="<?php echo site_url('dashboard'); ?>" title="<?php _trans('dashboard'); ?>"
               class="tip" data-placement="right"><?php _trans('dashboard'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Home.png"></i>
            </a>
        </li>
        <li class="dropdown"><div>
            <a title="<?php _trans('clients'); ?>"
               class="tip dropdown-btn" data-placement="right"><?php _trans('clients'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/User.png"></i>
            </a></div>
            <ul class="dropdown-menu">
                        <li><?php echo anchor('clients/form', trans('add_client')); ?></li>
                        <li><?php echo anchor('clients/index', trans('view_clients')); ?></li>
                    </ul>
        </li>
        <li class="dropdown"><div>
            <a title="<?php _trans('quotes'); ?>"
               class="tip dropdown-btn" data-placement="right"><?php _trans('quotes'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Document-2.png"></i>
            </a></div>
            <ul class="dropdown-menu">
                        <li><?php echo anchor('quotes/createquote', trans('create_quote')); ?></li>
                        <li><?php echo anchor('quotes/index', trans('view_quotes')); ?></li>
                    </ul>
        </li>
        <li class="dropdown"><div>
            <a title="<?php _trans('invoices'); ?>"
               class="tip dropdown-btn" data-placement="right"><?php _trans('invoices'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Document.png"></i>
            </a></div>
            <ul class="dropdown-menu">
                        <!-- <li><a href="#" class="create-invoice"> --><?php //  _trans('create_invoice'); ?><!-- </a></li> -->
                        <li><?php echo anchor('invoices/createinvoice', trans('create_invoice')); ?></li>
                        <li><?php echo anchor('invoices/index', trans('view_invoices')); ?></li>
                        <li><?php echo anchor('invoices/recurring/index', trans('view_recurring_invoices')); ?></li>
                    </ul>
        </li>
        <li class="dropdown"><div>
            <a title="<?php _trans('payments'); ?>"
               class="tip dropdown-btn" data-placement="right"><?php _trans('payments'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Dollar_bag.png"></i>
            </a></div>
            <ul class="dropdown-menu">
                        <li><?php echo anchor('payments/form', trans('enter_payment')); ?></li>
                        <li><?php echo anchor('payments/index', trans('view_payments')); ?></li>
                        <li><?php echo anchor('payments/online_logs', trans('view_payment_logs')); ?></li>
                    </ul>
        </li>
        <li class="dropdown"><div>
            <a title="<?php _trans('products'); ?>"
               class="tip dropdown-btn" data-placement="right"><?php _trans('products'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Gift.png"></i>
            </a></div>
            <ul class="dropdown-menu">
                        <li><?php echo anchor('products/form', trans('create_product')); ?></li>
                        <li><?php echo anchor('products/index', trans('view_products')); ?></li>
                        <li><?php echo anchor('families/index', trans('product_families')); ?></li>
                        <li><?php echo anchor('units/index', trans('product_units')); ?></li>
                    </ul>
        </li>
        <?php if (get_setting('projects_enabled') == 1) : ?>
            <li class="dropdown"><div>
                <a title="<?php _trans('tasks'); ?>"
                   class="tip dropdown-btn" data-placement="right"><?php _trans('tasks'); ?>
                    <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/List.png"></i>
                </a></div>
                <ul class="dropdown-menu">
                        <li><?php echo anchor('tasks/form', trans('create_task')); ?></li>
                        <li><?php echo anchor('tasks/index', trans('show_tasks')); ?></li>
                        <li><?php echo anchor('projects/index', trans('projects')); ?></li>
                    </ul>
            </li>
        <?php endif; ?>
        <!--  <li>
            <a href="<?php echo site_url('settings'); ?>" title="<?php _trans('system_settings'); ?>"
               class="tip" data-placement="right"><?php _trans('settings'); ?>
                <i class="fa"><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Icons/Home.png"></i>
            </a>
        </li>-->
    </ul>
</div>