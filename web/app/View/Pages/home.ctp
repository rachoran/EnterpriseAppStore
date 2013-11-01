<?php

?><div class="widget">
	<div class="widget-controls pull-right"> <a href="#" class="widget-link-remove"><i class="icon-minus-sign"></i></a> <a href="#" class="widget-link-remove"><i class="icon-remove-sign"></i></a> </div>
	<h3 class="section-title first-title"><i class="icon-tasks"></i> Statistics</h3>
	<div class="row">
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<div class="widget-content-blue-wrapper changed-up">
				<div class="widget-content-blue-inner padded">
					<div class="pre-value-block"><i class="icon-dashboard"></i> Total Visits</div>
					<div class="value-block">
						<div class="value-self">10,520</div>
						<div class="value-sub">This Week</div>
					</div>
					<span class="dynamicsparkline">Loading..</span> </div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<div class="widget-content-blue-wrapper changed-up">
				<div class="widget-content-blue-inner padded">
					<div class="pre-value-block"><i class="icon-user"></i> New Users</div>
					<div class="value-block">
						<div class="value-self">1,120</div>
						<div class="value-sub">This Month</div>
					</div>
					<span class="dynamicsparkline">Loading..</span> </div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 text-center hidden-md">
			<div class="widget-content-blue-wrapper changed-up">
				<div class="widget-content-blue-inner padded">
					<div class="pre-value-block"><i class="icon-signin"></i> Sold Items</div>
					<div class="value-block">
						<div class="value-self">275</div>
						<div class="value-sub">This Week</div>
					</div>
					<span class="dynamicsparkline">Loading..</span> </div>
			</div>
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<div class="widget-content-blue-wrapper changed-up">
				<div class="widget-content-blue-inner padded">
					<div class="pre-value-block"><i class="icon-money"></i> Net Profit</div>
					<div class="value-block">
						<div class="value-self">$9,240</div>
						<div class="value-sub">Yesterday</div>
					</div>
					<span class="dynamicbars">Loading..</span> </div>
			</div>
		</div>
	</div>
</div>
<div class="widget">
	<div class="widget-controls pull-right"> <a href="#" class="widget-link-remove"><i class="icon-minus-sign"></i></a> <a href="#" class="widget-link-remove"><i class="icon-remove-sign"></i></a> </div>
	<h3 class="section-title"><i class="icon-bar-chart"></i> Profit Chart</h3>
	<ul class="nav nav-pills">
		<li class="active"><a href="#">Hour</a></li>
		<li><a href="#">Day</a></li>
		<li><a href="#">Month</a></li>
		<li class="hidden-xs"><a href="#">Year</a></li>
	</ul>
	<div class="widget-content-white">
		<div class="shadowed-bottom bottom-margin">
			<div class="row">
				<div class="col-lg-4 col-md-5 col-sm-6 bordered">
					<div class="value-block value-bigger changed-up some-left-padding">
						<div class="value-self"> $5,450 <span class="changed-icon"><i class="icon-caret-up"></i></span> <span class="changed-value">+5.00%</span> </div>
						<div class="value-sub">Average of $450.35 Per Day</div>
					</div>
				</div>
				<div class="col-lg-2 col-md-3 visible-md visible-lg bordered">
					<div class="value-block text-center">
						<div class="value-self">520</div>
						<div class="value-sub">Total Sales</div>
					</div>
				</div>
				<div class="col-lg-2 bordered visible-lg">
					<div class="value-block text-center">
						<div class="value-self">1,120</div>
						<div class="value-sub">Total Visitors</div>
					</div>
				</div>
				<div class="col-lg-4 col-md-4 col-sm-6">
					<form class="form-inline form-period-selector">
						<label class="control-label">Time Period:</label>
						<br>
						<input type="text" placeholder="01/12/2011" class="form-control input-sm">
						<input type="text" placeholder="01/12/2011" class="form-control input-sm">
					</form>
				</div>
			</div>
		</div>
		<div class="padded">
			<div id="areachart" style="height: 250px;"></div>
		</div>
	</div>
</div>
<div class="widget">
	<div class="widget-controls pull-right"> <a href="#" class="widget-link-remove"><i class="icon-minus-sign"></i></a> <a href="#" class="widget-link-remove"><i class="icon-remove-sign"></i></a> </div>
	<h3 class="section-title bottom-margin"><i class="icon-bullseye"></i> Circular Charts</h3>
	<div class="row bottom-margin">
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<input type="text" value="75" class="knob" data-fgColor="#df6064" data-linecap="round" data-width="150">
		</div>
		<div class="col-lg-3 hidden-md col-sm-6 text-center">
			<input type="text" value="65" class="knob" data-fgColor="#8963ac" data-linecap="round" data-width="150">
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<input type="text" value="85" class="knob" data-fgColor="#61a9dc" data-linecap="round" data-width="150">
		</div>
		<div class="col-lg-3 col-md-4 col-sm-6 text-center">
			<input type="text" value="68" class="knob" data-fgColor="#71c280" data-linecap="round" data-width="150">
		</div>
	</div>
</div>
<div class="row">
	<div class="col-md-8">
		<ul class="nav nav-tabs">
			<li class="active"><a href="#tab_pie_chart" data-toggle="tab"><i class="icon-bullseye"></i> Pie Chart</a></li>
			<li><a href="#tab_bar_chart" data-toggle="tab"><i class="icon-bar-chart"></i> Bar Alert</a></li>
			<li class="hidden-md hidden-xs"><a href="#tab_table" data-toggle="tab"><i class="icon-table"></i> Table</a></li>
		</ul>
		<div class="tab-content bottom-margin">
			<div class="tab-pane active" id="tab_pie_chart">
				<div class="shadowed-bottom">
					<div class="row">
						<div class="col-lg-3 col-md-4 col-sm-3 bordered">
							<div class="value-block padded-left text-center">
								<div class="value-self">520</div>
								<div class="value-sub">Total Sales</div>
							</div>
						</div>
						<div class="col-lg-3 col-sm-3 bordered hidden-md">
							<div class="value-block text-center">
								<div class="value-self">1,120</div>
								<div class="value-sub">Total Visitors</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-8 col-sm-6">
							<form class="form-inline form-period-selector">
								<label class="control-label">Time Period:</label>
								<br>
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
							</form>
						</div>
					</div>
				</div>
				<div class="padded">
					<div id="piechart" style=""></div>
				</div>
			</div>
			<div class="tab-pane" id="tab_bar_chart">
				<div class="shadowed-bottom">
					<div class="row">
						<div class="col-md-3 bordered">
							<div class="value-block padded-left text-center">
								<div class="value-self">256</div>
								<div class="value-sub">Total Sales</div>
							</div>
						</div>
						<div class="col-lg-3 bordered hidden-md">
							<div class="value-block text-center">
								<div class="value-self">3,420</div>
								<div class="value-sub">Total Visitors</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-9">
							<form class="form-inline form-period-selector">
								<label class="control-label">Time Period:</label>
								<br>
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
							</form>
						</div>
					</div>
				</div>
				<div class="padded">
					<div class="alert alert-warning"> <i class="icon-exclamation-sign"></i> <strong>Message example!</strong> This is an example of how to handle a case when there is no data to load for a chart.</div>
				</div>
			</div>
			<div class="tab-pane" id="tab_table">
				<div class="shadowed-bottom">
					<div class="row">
						<div class="col-md-3 bordered">
							<div class="value-block padded-left text-center">
								<div class="value-self">112</div>
								<div class="value-sub">Total Sales</div>
							</div>
						</div>
						<div class="col-lg-3 bordered hidden-md">
							<div class="value-block text-center">
								<div class="value-self">2,340</div>
								<div class="value-sub">Total Visitors</div>
							</div>
						</div>
						<div class="col-lg-6 col-md-9">
							<form class="form-inline form-period-selector">
								<label class="control-label">Time Period:</label>
								<br>
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
								<input type="text" placeholder="01/12/2011" class="form-control input-sm">
							</form>
						</div>
					</div>
				</div>
				<div class="padded">
					<table class="table">
						<thead>
							<tr>
								<th>Product</th>
								<th>Qty</th>
								<th>Price</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>Floor Lamp</td>
								<td>2</td>
								<td>3</td>
							</tr>
							<tr>
								<td>Coffee Mug</td>
								<td>4</td>
								<td>7</td>
							</tr>
							<tr>
								<td>Television</td>
								<td>1</td>
								<td>3</td>
							</tr>
							<tr>
								<td>Red Carpet</td>
								<td>6</td>
								<td>5</td>
							</tr>
							<tr>
								<td>Laptop</td>
								<td>3</td>
								<td>6</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-4">
		<div class="widget">
			<div class="widget-controls pull-right hidden-md"> <a href="#" class="widget-link-remove"><i class="icon-minus-sign"></i></a> <a href="#" class="widget-link-remove"><i class="icon-remove-sign"></i></a> </div>
			<h3 class="section-title first-title"><i class="icon-table"></i> Top Sellers</h3>
			<div class="widget-content-white padded glossed">
				<div id="topsellers_barchart"></div>
				<table class="table" id="topsellers_table">
					<thead>
						<tr>
							<th>Product</th>
							<th>Qty</th>
							<th>Price</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Floor Lamp</td>
							<td>2</td>
							<td>3</td>
						</tr>
						<tr>
							<td>Coffee Mug</td>
							<td>4</td>
							<td>7</td>
						</tr>
						<tr>
							<td>Television</td>
							<td>1</td>
							<td>3</td>
						</tr>
						<tr>
							<td>Red Carpet</td>
							<td>6</td>
							<td>5</td>
						</tr>
						<tr>
							<td>Laptop</td>
							<td>3</td>
							<td>6</td>
						</tr>
					</tbody>
				</table>
				<a href="#" class="btn btn-sm btn-default">view more</a>
			</div>
		</div>
	</div>
</div>