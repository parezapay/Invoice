<div class="sidebar hidden-xs">
    <ul>
    	<li ><img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Pareza_Invoice_Logo.png"></li>
        <li >
            <a class="active" href="<?php echo site_url('dashboard'); ?>" title="<?php _trans('dashboard'); ?>"
               class="tip" data-placement="right"><?php _trans('dashboard'); ?>
                <i class="fa fa-home"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('clients/index'); ?>" title="<?php _trans('clients'); ?>"
               class="tip" data-placement="right"><?php _trans('clients'); ?>
                <i class="fa fa-user"></i>
        
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('quotes/index'); ?>" title="<?php _trans('quotes'); ?>"
               class="tip" data-placement="right"><?php _trans('quotes'); ?>
                <i class="fa fa-file"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('invoices/index'); ?>" title="<?php _trans('invoices'); ?>"
               class="tip" data-placement="right"><?php _trans('invoices'); ?>
                <i class="fa fa-folder-open"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('payments/index'); ?>" title="<?php _trans('payments'); ?>"
               class="tip" data-placement="right"><?php _trans('payments'); ?>
                <i class="fa fa-usd"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('products/index'); ?>" title="<?php _trans('products'); ?>"
               class="tip" data-placement="right"><?php _trans('products'); ?>
                <i class="fa fa-product-hunt"></i>
            </a>
        </li>
        <?php if (get_setting('projects_enabled') == 1) : ?>
            <li>
                <a href="<?php echo site_url('tasks/index'); ?>" title="<?php _trans('tasks'); ?>"
                   class="tip" data-placement="right"><?php _trans('tasks'); ?>
                    <i class="fa fa-tasks"></i>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="<?php echo site_url('settings'); ?>" title="<?php _trans('system_settings'); ?>"
               class="tip" data-placement="right"><?php _trans('settings'); ?>
                <i class="fa fa-cog"></i>
            </a>
        </li>
    </ul>
</div>
