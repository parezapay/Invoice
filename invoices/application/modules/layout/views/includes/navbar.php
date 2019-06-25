<nav class="navbar navbar-inverse" role="navigation">
    <div class="container-fluid">
        <!--  <div class="navbar-header">
        	<div class="img" style="display: none;">
				<img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Logo1.png"></div>
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#ip-navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <?php echo trans('menu') ?> &nbsp; <i class="fa fa-bars"></i>
            </button>
        </div>-->

        <div class="collapse navbar-collapse" id="ip-navbar-collapse">
           

            <?php if (isset($filter_display) and $filter_display == true) { ?>
                <?php $this->layout->load_view('filter/jquery_filter'); ?>
                <form class="navbar-form navbar-left" role="search" onsubmit="return false;">
                    <div class="form-group">
                        <input id="filter" type="text" class="search-query form-control input-sm"
                               placeholder="<?php echo $filter_placeholder; ?>">
                    </div>
                </form>
            <?php } ?>

            <ul class="nav navbar-nav navbar-right">
              <!--   <li> 
                    <a href="http://docs.invoiceplane.com/" target="_blank"
                       class="tip icon" title="<?php _trans('documentation'); ?>"
                       data-placement="bottom">
                        <i class="fa fa-question-circle"></i>
                        <span class="visible-xs">&nbsp;<?php // _trans('documentation'); ?></span>
                    </a>
                </li>-->

                <li class="dropdown" style="margin-top: 10px;">
                    <a href="#" class="tip icon dropdown-toggle" data-toggle="dropdown"
                       title="<?php _trans('settings'); ?>"
                       data-placement="bottom">
                        <i class="fa"><img alt="settings" src="<?php echo base_url(); ?>/assets/core/img/settings_icon.png"></i>
                        <span class="visible-xs">&nbsp;<?php _trans('settings'); ?></span>
                    </a>
                    <ul class="dropdown-menu">
                        <li><?php echo anchor('custom_fields/index', trans('custom_fields')); ?></li>
                        <li><?php echo anchor('email_templates/index', trans('email_templates')); ?></li>
                        <li><?php echo anchor('invoice_groups/index', trans('invoice_groups')); ?></li>
                        <li><?php echo anchor('invoices/archive', trans('invoice_archive')); ?></li>
                        <!-- // temporarily disabled
                        <li><?php echo anchor('item_lookups/index', trans('item_lookups')); ?></li>
                        -->
                        <li><?php echo anchor('payment_methods/index', trans('payment_methods')); ?></li>
                        <li><?php echo anchor('tax_rates/index', trans('tax_rates')); ?></li>
                        <li><?php echo anchor('users/index', trans('user_accounts')); ?></li>
                        <li class="divider hidden-xs hidden-sm"></li>
                        <li><?php echo anchor('settings', trans('system_settings')); ?></li>
                        <li><?php echo anchor('import', trans('import_data')); ?></li>
                    </ul>
                </li>
                
                <li style="margin-top: 10px;">
                    <a href="<?php echo site_url('sessions/logout'); ?>"
                       class="tip icon logout" data-placement="bottom"
                       title="<?php _trans('logout'); ?>">
                        <i class="fa"><img alt="log-out" src="<?php echo base_url(); ?>/assets/core/img/Take_off.png"></i>
                        <span class="visible-xs">&nbsp;<?php _trans('logout'); ?></span>
                    </a>
                </li>
                
                <li>
                    <a href="<?php echo site_url('users/form/' .
                        $this->session->userdata('user_id')); ?>"
                       class="tip icon" data-placement="bottom"
                       title="<?php
                       _htmlsc($this->session->userdata('user_name'));
                       if ($this->session->userdata('user_company')) {
                           print(" (" . htmlsc($this->session->userdata('user_company')) . ")");
                       }
                       ?>">
                        <i class="fa"><img alt="profile" src="<?php echo base_url(); ?>/assets/core/img/profile.png"></i>
                        <span class="visible-xs">&nbsp;<?php
                            _htmlsc($this->session->userdata('user_name'));
                            if ($this->session->userdata('user_company')) {
                                print(" (" . htmlsc($this->session->userdata('user_company')) . ")");
                            }
                            ?></span>
                    </a>
                </li>
                
            </ul>
        </div>
    </div>
</nav>


