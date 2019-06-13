<div class="sidebar hidden-xs">
    <ul>
        <li>
            <a href="<?php echo site_url('clients/index'); ?>" title="<?php _trans('clients'); ?>"
               class="tip" data-placement="right"><?php _trans('clients'); ?>
                <i class="fa fa-users"></i>
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
                <i class="fa fa-file-text"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('payments/index'); ?>" title="<?php _trans('payments'); ?>"
               class="tip" data-placement="right"><?php _trans('payments'); ?>
                <i class="fa fa-money"></i>
            </a>
        </li>
        <li>
            <a href="<?php echo site_url('products/index'); ?>" title="<?php _trans('products'); ?>"
               class="tip" data-placement="right"><?php _trans('products'); ?>
                <i class="fa fa-database"></i>
            </a>
        </li>
        <?php if (get_setting('projects_enabled') == 1) : ?>
            <li>
                <a href="<?php echo site_url('tasks/index'); ?>" title="<?php _trans('tasks'); ?>"
                   class="tip" data-placement="right"><?php _trans('tasks'); ?>
                    <i class="fa fa-check-square-o"></i>
                </a>
            </li>
        <?php endif; ?>
        <li>
            <a href="<?php echo site_url('settings'); ?>" title="<?php _trans('system_settings'); ?>"
               class="tip" data-placement="right"><?php _trans('system_settings'); ?>
                <i class="fa fa-cogs"></i>
            </a>
        </li>
    </ul>
</div>
