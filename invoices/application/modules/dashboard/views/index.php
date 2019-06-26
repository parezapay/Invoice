<div id="content" >
    <?php echo $this->layout->load_view('layout/alerts'); ?>

    <div class="row <?php if (get_setting('disable_quickactions') == 1) echo 'hidden'; ?>" >
        <div class="col-xs-12">

            <div id="panel-quick-actions" class="panel panel-default quick-actions">

                <div class="panel-heading">
                    <b><?php _trans('quick_actions'); ?></b>
                </div>

                <div class="btn-group btn-group-justified no-margin">
                    <a href="<?php echo site_url('clients/form'); ?>" class="btn btn-default">
                        <i class="fa fa-user fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('add_client'); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="create-quote btn btn-default">
                        <i class="fa fa-file fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('create_quote'); ?></span>
                    </a>
                    <a href="javascript:void(0)" class="create-invoice btn btn-default">
                        <i class="fa fa-file-text fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('create_invoice'); ?></span>
                    </a>
                    <a href="<?php echo site_url('payments/form'); ?>" class="btn btn-default">
                        <i class="fa fa-credit-card fa-margin"></i>
                        <span class="hidden-xs"><?php _trans('enter_payment'); ?></span>
                    </a>
                </div>

            </div>
        </div>
    </div>
    <div class="row">
    	<div class="col-xs-12" style="padding: 0px;"> 
    		<div class="col-sm-6" style="padding: 0px;">
    			<div class="dash-title">Dashboard</div>
    		</div>
    		<div class="col-sm-6">
    			
    		</div>
    		
    		
    		<div class="pull-right"><p>10:14, Wednesday, Jun 12, 2019</p></div>
    	</div>
    </div>
	<div class="row top-marg">
    	
		<div class="col-xs-12 col-md-4" style="padding-left: 0px;">
		 <div class="info-box1">
		 	<h4>Total Revenue</h4>
		 	<h2>$ 65,780.00</h2>
		 	<img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Group_3.png">
		 </div>
		</div>
		<div class="col-xs-12 col-md-4">
		 <div class="info-box2">
		 	<h4>Total Expenses</h4>
		 	<h2>$ 5,655.00</h2>
		 	<img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Group_2.png">
		 </div>
		</div>
		<div class="col-xs-12 col-md-4" style="padding: 0px 35px;;">
		 <div class="info-box3">
		 	<h4>Create</h4>
		 	<h2><a href="#">New Invoice</a></h2>
		 	<img alt="logo" src="<?php echo base_url(); ?>/assets/core/img/Oval_Copy.png">
		 	<hr>
		 </div>
		</div>
	</div>
	
    <div class="row" style="margin-top: 30px; margin-bottom: 15px;">
        <div class="col-xs-12" style="padding: 0px;"> 
        	<div class="col-sm-4" style="padding-left: 0px;">
        		<div class="table-shadow">
        		<div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Structure</h4>
                            	<div id="morris-donut-example" class="morris-chart" style="height: 300px"><svg height="300"  style="overflow: hidden; position: relative; left: -0.5px; top: -0.75px;"><path style="opacity: 1;" fill="none" stroke="#4bbbce" d="M127.5,228.33333333333331A78.33333333333333,78.33333333333333,0,0,0,201.65753572921528,175.23432197783941" stroke-width="2" opacity="1"></path><path style="" fill="#4bbbce" stroke="#ffffff" d="M127.5,231.33333333333331A81.33333333333333,81.33333333333333,0,0,0,204.4976115656533,176.2007428195439L238.73630359382292,187.85148296675914A117.5,117.5,0,0,1,127.5,267.5Z" stroke-width="3"></path><path style="opacity: 0;" fill="none" stroke="#5985ee" d="M201.65753572921528,175.23432197783941A78.33333333333333,78.33333333333333,0,0,0,57.25053215479218,115.34277306857598" stroke-width="2" opacity="0"></path><path style="" fill="#5985ee" stroke="#ffffff" d="M204.4976115656533,176.2007428195439A81.33333333333333,81.33333333333333,0,0,0,54.56012700327358,114.01547501588314L26.60980681805259,100.22632302401868A112.5,112.5,0,0,1,234.00284386642622,186.24078156391832Z" stroke-width="3"></path><path style="opacity: 0;" fill="none" stroke="#46cd93" d="M57.25053215479218,115.34277306857598A78.33333333333333,78.33333333333333,0,0,0,127.4753908579517,228.3333294677383" stroke-width="2" opacity="0"></path><path style="" fill="#46cd93" stroke="#ffffff" d="M54.56012700327358,114.01547501588314A81.33333333333333,81.33333333333333,0,0,0,127.47444838017113,231.33332931969426L127.4646570832285,262.4999944483476A112.5,112.5,0,0,1,26.60980681805259,100.22632302401868Z" stroke-width="3"></path><text style="text-anchor: middle; font-family: &quot;Arial&quot;; font-size: 15px; font-weight: 800;" x="127.5" y="140" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="15px" stroke="none" fill="#000000" font-weight="800" transform="matrix(1.1949,0,0,1.1949,-24.8517,-29.4322)" stroke-width="0.8368794326241136"><text style="text-anchor: middle; font-family: &quot;Arial&quot;; font-size: 14px;" x="127.5" y="160" text-anchor="middle" font-family="&quot;Arial&quot;" font-size="14px" stroke="none" fill="#000000" transform="matrix(1.3056,0,0,1.3056,-38.9583,-45.8333)" stroke-width="0.7659574468085106"><tspan dy="5">12</tspan></text></svg>
                            	
                            	</div>
                            </div>
                        </div>
                        </div>
        	</div>
        	
        	<div class="col-sm-8" style="padding-right: 0px;">
        		<div class="table-shadow">
				<div class="card">
                            <div class="card-body">
                                <h4 class="mt-0 header-title">Total Revenue</h4>
                                <div class="row">
                                    <div class="col-lg-8">
                                        <div id="morris-line-example" class="morris-chart" style="height: 300px; position: relative;"><svg height="300" version="1.1" width="593.333" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="overflow: hidden; position: relative; left: -0.5px; top: -0.75px;"><desc>Created with Raphaël 2.2.0</desc><defs></defs><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="36.5" y="260" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.5">0</tspan></text><path style="" fill="none" stroke="#eef0f2" d="M49,260H568.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="36.5" y="201.25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.5">25</tspan></text><path style="" fill="none" stroke="#eef0f2" d="M49,201.25H568.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="36.5" y="142.5" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.5">50</tspan></text><path style="" fill="none" stroke="#eef0f2" d="M49,142.5H568.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="36.5" y="83.75" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.5">75</tspan></text><path style="" fill="none" stroke="#eef0f2" d="M49,83.75H568.333" stroke-width="0.5"></path><text style="text-anchor: end; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="36.5" y="25" text-anchor="end" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal"><tspan dy="4.5">100</tspan></text><path style="" fill="none" stroke="#eef0f2" d="M49,25H568.333" stroke-width="0.5"></path><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="568.333" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2018</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="481.85647399635036" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2017</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="395.14302600364965" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2016</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="308.6665" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2015</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="222.18997399635037" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2014</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="135.71344799270074" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2013</tspan></text><text style="text-anchor: middle; font-family: sans-serif; font-size: 12px; font-weight: normal;" x="49" y="272.5" text-anchor="middle" font-family="sans-serif" font-size="12px" stroke="none" fill="#888888" font-weight="normal" transform="matrix(1,0,0,1,0,8.5)"><tspan dy="4.5">2012</tspan></text><path style="" fill="none" stroke="#46cd93" d="M49,107.25C70.67836199817518,89.625,114.03508599452556,29.39620383036936,135.71344799270074,36.75C157.33257949361314,44.08370383036936,200.57084249543797,157.1875,222.18997399635037,166C243.80910549726278,174.8125,287.0473684990876,107.25,308.6665,107.25C330.2856315009124,107.25,373.5238945027372,168.93348153214774,395.14302600364965,166C416.82138800182486,163.05848153214774,460.17811199817515,98.45759233926128,481.85647399635036,83.75C503.4756054972628,69.08259233926128,546.7138684990875,57.3125,568.333,48.5" stroke-width="3"></path><path style="" fill="none" stroke="#5985ee" d="M49,154.25C70.67836199817518,136.625,114.03508599452556,85.22075923392613,135.71344799270074,83.75C157.33257949361314,82.28325923392613,200.57084249543797,148.375,222.18997399635037,142.5C243.80910549726278,136.625,287.0473684990876,36.75,308.6665,36.75C330.2856315009124,36.75,373.5238945027372,133.69955540355676,395.14302600364965,142.5C416.82138800182486,151.32455540355676,460.17811199817515,116.07455540355677,481.85647399635036,107.25C503.4756054972628,98.44955540355677,546.7138684990875,80.8125,568.333,72" stroke-width="3"></path><circle cx="49" cy="107.25" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="135.71344799270074" cy="36.75" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="222.18997399635037" cy="166" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="308.6665" cy="107.25" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="395.14302600364965" cy="166" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="481.85647399635036" cy="83.75" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="568.333" cy="48.5" r="4" fill="#46cd93" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="49" cy="154.25" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="135.71344799270074" cy="83.75" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="222.18997399635037" cy="142.5" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="308.6665" cy="36.75" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="395.14302600364965" cy="142.5" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="481.85647399635036" cy="107.25" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle><circle cx="568.333" cy="72" r="4" fill="#5985ee" stroke="#ffffff" style="" stroke-width="1"></circle></svg><div class="morris-hover morris-default-style" style="left: 0px; top: 6px; display: none;"><div class="morris-hover-row-label">2012</div><div class="morris-hover-point" style="color: #5985ee">
  Series A:
  45
</div><div class="morris-hover-point" style="color: #46cd93">
  Series B:
  65
</div></div></div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            

                                            <div>
                                                <h5 class="mb-3" style="text-align: right; margin-right:25px;">2018</h5>
                                                
                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </div>
        	</div>
        </div>
    </div>
	
    <div class="row" style="display: none;">
        <div class="col-xs-12 col-md-6">

            <div id="panel-quote-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> <?php _trans('quote_overview'); ?></b>
                    <span class="pull-right text-muted"><?php echo lang($quote_status_period); ?></span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                    <?php foreach ($quote_status_totals as $total) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url($total['href']); ?>">
                                    <?php echo $total['label']; ?>
                                </a>
                            </td>
                            <td class="amount">
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>

        </div>
        <div class="col-xs-12 col-md-6" >

            <div id="panel-invoice-overview" class="panel panel-default overview">

                <div class="panel-heading">
                    <b><i class="fa fa-bar-chart fa-margin"></i> <?php _trans('invoice_overview'); ?></b>
                    <span class="pull-right text-muted"><?php echo lang($invoice_status_period); ?></span>
                </div>

                <table class="table table-bordered table-condensed no-margin">
                    <?php foreach ($invoice_status_totals as $total) { ?>
                        <tr>
                            <td>
                                <a href="<?php echo site_url($total['href']); ?>">
                                    <?php echo $total['label']; ?>
                                </a>
                            </td>
                            <td class="amount">
                        <span class="<?php echo $total['class']; ?>">
                            <?php echo format_currency($total['sum_total']); ?>
                        </span>
                            </td>
                        </tr>
                    <?php } ?>
                </table>
            </div>


            <?php if (empty($overdue_invoices)) { ?>
                <div class="panel panel-default panel-heading">
                    <span class="text-muted"><?php _trans('no_overdue_invoices'); ?></span>
                </div>
            <?php } else {
                $overdue_invoices_total = 0;
                foreach ($overdue_invoices as $invoice) {
                    $overdue_invoices_total += $invoice->invoice_balance;
                }
                ?>
                <div class="panel panel-danger panel-heading">
                    <?php echo anchor('invoices/status/overdue', '<i class="fa fa-external-link"></i> ' . trans('overdue_invoices'), 'class="text-danger"'); ?>
                    <span class="pull-right text-danger">
                        <?php echo format_currency($overdue_invoices_total); ?>
                    </span>
                </div>
            <?php } ?>

        </div>
    </div>

    <div class="row" style="display: none;">
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-quotes" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> <?php _trans('recent_quotes'); ?></b>
                </div>
                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th><?php _trans('status'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('date'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('quote'); ?></th>
                            <th style="min-width: 35%;"><?php _trans('client'); ?></th>
                            <th style="text-align: right;"><?php _trans('balance'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($quotes as $quote) { ?>
                            <tr>
                                <td>
                                <span class="label
                                <?php echo $quote_statuses[$quote->quote_status_id]['class']; ?>">
                                    <?php echo $quote_statuses[$quote->quote_status_id]['label']; ?>
                                </span>
                                </td>
                                <td>
                                    <?php echo date_from_mysql($quote->quote_date_created); ?>
                                </td>
                                <td>
                                    <?php echo anchor('quotes/view/' . $quote->quote_id, ($quote->quote_number ? $quote->quote_number : $quote->quote_id)); ?>
                                </td>
                                <td>
                                    <?php echo anchor('clients/view/' . $quote->client_id, htmlsc(format_client($quote))); ?>
                                </td>
                                <td class="amount">
                                    <?php echo format_currency($quote->quote_total); ?>
                                </td>
                                <td style="text-align: center;">
                                    <a href="<?php echo site_url('quotes/generate_pdf/' . $quote->quote_id); ?>"
                                       title="<?php _trans('download_pdf'); ?>">
                                        <i class="fa fa-file-pdf-o"></i>
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right small">
                                <?php echo anchor('quotes/status/all', trans('view_all')); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
        <div class="col-xs-12 col-md-6">

            <div id="panel-recent-invoices" class="panel panel-default">

                <div class="panel-heading">
                    <b><i class="fa fa-history fa-margin"></i> <?php _trans('recent_invoices'); ?></b>
                </div>

                <div class="table-responsive">
                    <table class="table table-striped table-condensed no-margin">
                        <thead>
                        <tr>
                            <th><?php _trans('status'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('due_date'); ?></th>
                            <th style="min-width: 15%;"><?php _trans('invoice'); ?></th>
                            <th style="min-width: 35%;"><?php _trans('client'); ?></th>
                            <th style="text-align: right;"><?php _trans('balance'); ?></th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>

                        <?php foreach ($invoices as $invoice) {
                            if ($this->config->item('disable_read_only') == true) {
                                $invoice->is_read_only = 0;
                            } ?>
                            <tr>
                                <td>
                                    <span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label'];
                                        if ($invoice->invoice_sign == '-1') { ?>
                                            &nbsp;<i class="fa fa-credit-invoice"
                                                     title="<?php _trans('credit_invoice') ?>"></i>
                                        <?php }
                                        if ($invoice->is_read_only == 1) { ?>
                                            &nbsp;<i class="fa fa-read-only"
                                                     title="<?php _trans('read_only') ?>"></i>
                                        <?php }; ?>
                                    </span>
                                </td>
                                <td>
                                    <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                                    </span>
                                </td>
                                <td>
                                    <?php echo anchor('invoices/view/' . $invoice->invoice_id, ($invoice->invoice_number ? $invoice->invoice_number : $invoice->invoice_id)); ?>
                                </td>
                                <td>
                                    <?php echo anchor('clients/view/' . $invoice->client_id, htmlsc(format_client($invoice))); ?>
                                </td>
                                <td class="amount">
                                    <?php echo format_currency($invoice->invoice_balance * $invoice->invoice_sign); ?>
                                </td>
                                <td style="text-align: center;">
                                    <?php if ($invoice->sumex_id != null): ?>
                                        <a href="<?php echo site_url('invoices/generate_sumex_pdf/' . $invoice->invoice_id); ?>"
                                           title="<?php _trans('download_pdf'); ?>">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                           title="<?php _trans('download_pdf'); ?>">
                                            <i class="fa fa-file-pdf-o"></i>
                                        </a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php } ?>
                        <tr>
                            <td colspan="6" class="text-right small">
                                <?php echo anchor('invoices/status/all', trans('view_all')); ?>
                            </td>
                        </tr>
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>

    <?php if (get_setting('projects_enabled') == 1) : ?>
        <div class="row" style="display: none;">
            <div class="col-xs-12 col-md-6">

                <div id="panel-projects" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-list fa-margin"></i> <?php _trans('projects'); ?></b>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">
                            <thead>
                            <tr>
                                <th><?php _trans('project_name'); ?></th>
                                <th><?php _trans('client_name'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($projects as $project) { ?>
                                <tr>
                                    <td>
                                        <?php echo anchor('projects/view/' . $project->project_id, htmlsc($project->project_name)); ?>
                                    </td>
                                    <td>
                                        <?php echo anchor('clients/view/' . $project->client_id, htmlsc(format_client($project))); ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>
                </div>

            </div>
            <div class="col-xs-12 col-md-6">

                <div id="panel-recent-invoices" class="panel panel-default">

                    <div class="panel-heading">
                        <b><i class="fa fa-check-square-o fa-margin"></i> <?php _trans('tasks'); ?></b>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-condensed no-margin">

                            <thead>
                            <tr>
                                <th><?php _trans('status'); ?></th>
                                <th><?php _trans('task_name'); ?></th>
                                <th><?php _trans('task_finish_date'); ?></th>
                                <th><?php _trans('project'); ?></th>
                            </tr>
                            </thead>

                            <tbody>
                            <?php foreach ($tasks as $task) { ?>
                                <tr>
                                    <td>
                                    <span class="label <?php echo $task_statuses["$task->task_status"]['class']; ?>">
                                        <?php echo $task_statuses["$task->task_status"]['label']; ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?php echo anchor('tasks/form/' . $task->task_id, htmlsc($task->task_name)) ?>
                                    </td>
                                    <td>
                                    <span class="<?php if ($task->is_overdue) { ?>text-danger<?php } ?>">
                                        <?php echo date_from_mysql($task->task_finish_date); ?>
                                    </span>
                                    </td>
                                    <td>
                                        <?php echo !empty($task->project_id) ? anchor('projects/view/' . $task->project_id, htmlsc($task->project_name)) : ''; ?>
                                    </td>
                                </tr>
                            <?php } ?>
                            </tbody>

                        </table>
                    </div>

                </div>

            </div>
        </div>
    <?php endif; ?>

</div>

<div class="table-shadow" style="margin-top: 30px;">
<h3>Invoices</h3>
<div class="table-responsive" >
    <table class="table table-striped">

        <thead>
        <tr>
            <th><?php _trans('status'); ?></th>
            <th><?php _trans('invoice'); ?></th>
            <th><?php _trans('created'); ?></th>
            <th><?php _trans('due_date'); ?></th>
            <th><?php _trans('client_name'); ?></th>
            <th style="text-align: left;"><?php _trans('amount'); ?></th>
            <th style="text-align: left;"><?php _trans('balance'); ?></th>
            <th><?php _trans('options'); ?></th>
        </tr>
        </thead>

        <tbody>
        <?php
        $invoice_idx = 1;
        $invoice_count = count($invoices);
        $invoice_list_split = $invoice_count > 3 ? $invoice_count / 2 : 9999;
        foreach ($invoices as $invoice) {
            // Disable read-only if not applicable
            if ($this->config->item('disable_read_only') == true) {
                $invoice->is_read_only = 0;
            }
            // Convert the dropdown menu to a dropup if invoice is after the invoice split
            $dropup = $invoice_idx > $invoice_list_split ? true : false;
            ?>
            <tr >
                <td >
                    <span class="label <?php echo $invoice_statuses[$invoice->invoice_status_id]['class']; ?>">
                        <?php echo $invoice_statuses[$invoice->invoice_status_id]['label'];
                        if ($invoice->invoice_sign == '-1') { ?>
                            &nbsp;<i class="fa fa-credit-invoice"
                                     title="<?php echo trans('credit_invoice') ?>"></i>
                        <?php }
                        if ($invoice->is_read_only == 1) { ?>
                            &nbsp;<i class="fa fa-read-only"
                                     title="<?php echo trans('read_only') ?>"></i>
                        <?php }; ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>"
                       title="<?php _trans('edit'); ?>">
                        <?php echo($invoice->invoice_number ? $invoice->invoice_number : $invoice->invoice_id); ?>
                    </a>
                </td>

                <td>
                    <?php echo date_from_mysql($invoice->invoice_date_created); ?>
                </td>

                <td>
                    <span class="<?php if ($invoice->is_overdue) { ?>font-overdue<?php } ?>">
                        <?php echo date_from_mysql($invoice->invoice_date_due); ?>
                    </span>
                </td>

                <td>
                    <a href="<?php echo site_url('clients/view/' . $invoice->client_id); ?>"
                       title="<?php _trans('view_client'); ?>">
                        <?php _htmlsc(format_client($invoice)); ?>
                    </a>
                </td>

                <td class="amount <?php if ($invoice->invoice_sign == '-1') {
                    echo 'text-danger';
                }; ?>">
                    <?php echo format_currency($invoice->invoice_total); ?>
                </td>

                <td class="amount">
                    <?php echo format_currency($invoice->invoice_balance); ?>
                </td>

                <td>
                    <div class="options btn-group<?php echo $dropup ? ' dropup' : ''; ?>">
                        <a class="btn btn-default btn-sm dropdown-toggle" data-toggle="dropdown" href="#">
                            <i class="fa "><img alt="option" src="<?php echo base_url(); ?>/assets/core/img/option-button-copy-4.png"></i>
                        </a>
                        <ul class="dropdown-menu">
                            <?php if ($invoice->is_read_only != 1) { ?>
                                <li>
                                    <a href="<?php echo site_url('invoices/view/' . $invoice->invoice_id); ?>">
                                        <i class="fa fa-edit fa-margin"></i> <?php _trans('edit'); ?>
                                    </a>
                                </li>
                            <?php } ?>
                            <li>
                                <a href="<?php echo site_url('invoices/generate_pdf/' . $invoice->invoice_id); ?>"
                                   target="_blank">
                                    <i class="fa fa-print fa-margin"></i> <?php _trans('download_pdf'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="<?php echo site_url('mailer/invoice/' . $invoice->invoice_id); ?>">
                                    <i class="fa fa-send fa-margin"></i> <?php _trans('send_email'); ?>
                                </a>
                            </li>
                            <li>
                                <a href="#" class="invoice-add-payment"
                                   data-invoice-id="<?php echo $invoice->invoice_id; ?>"
                                   data-invoice-balance="<?php echo $invoice->invoice_balance; ?>"
                                   data-invoice-payment-method="<?php echo $invoice->payment_method; ?>">
                                    <i class="fa fa-money fa-margin"></i>
                                    <?php _trans('enter_payment'); ?>
                                </a>
                            </li>
                            <?php if (
                                $invoice->invoice_status_id == 1 ||
                                ($this->config->item('enable_invoice_deletion') === true && $invoice->is_read_only != 1)
                            ) { ?>
                                <li>
                                    <form action="<?php echo site_url('invoices/delete/' . $invoice->invoice_id); ?>"
                                          method="POST">
                                        <?php _csrf_field(); ?>
                                        <button type="submit" class="dropdown-button"
                                                onclick="return confirm('<?php _trans('delete_invoice_warning'); ?>');">
                                            <i class="fa fa-trash-o fa-margin"></i> <?php _trans('delete'); ?>
                                        </button>
                                    </form>
                                </li>
                            <?php } ?>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php
            $invoice_idx++;
        } ?>
        </tbody>

    </table>
</div>
</div>

