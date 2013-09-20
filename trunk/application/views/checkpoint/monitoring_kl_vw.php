 <!--[if IE]><script language="javascript" type="text/javascript" src="<?=base_url()?>/public/admin/js/jqplot/excanvas.js"></script><![endif]-->
 
 <script language="javascript" type="text/javascript" src="<?=base_url()?>/public/admin/js/jqplot.1.0.8/jquery.jqplot.min.js"></script>
 <script language="javascript" type="text/javascript" src="<?=base_url()?>/public/admin/js/jqplot.1.0.8/plugins/jqplot.cursor.min.js"></script>
 <script language="javascript" type="text/javascript" src="<?=base_url()?>/public/admin/js/jqplot.1.0.8/plugins/jqplot.pieRenderer.min.js"></script>
 <link rel="stylesheet" type="text/css" href="<?=base_url()?>/public/admin/js/jqplot.1.0.8/jquery.jqplot.css" />
	
<div id="tb<?=$objectId;?>" style="height:auto">
	  <table border="0" cellpadding="1" cellspacing="1" width="100%">
	  <tr>
		<td>
		  <div class="fsearch" style="">
			<table border="0" cellpadding="1" cellspacing="1">
			<tr>
				<td>Tahun :</td>
				<td><?=$this->monitoring_kl_model->getListTahun($objectId)?></td>
			</tr>
			<tr>
				<td>Periode :</td>
				<td><?=$this->utility->getListCheckpoint("","cmbPeriode".$objectId)?></td>
			</tr>
			<!--<tr>
				<td>Bulan dari :</td>
				<td><?=$this->utility->getBulan("","cmbBulanStart".$objectId)?></td>
				<td>Sampai dengan :</td>
				<td><?=$this->utility->getBulan((intval(date("m"))-1),"cmbBulanEnd".$objectId)?></td>
			</tr>	
			-->
			<tr style="height:10px">
			  <td style="">
			  </td>
			</tr>
			<tr>			  
			  <td colspan="2" align="right">
				<!--<a href="#" class="easyui-linkbutton" onclick="clearFilter<?=$objectId;?>();" iconCls="icon-reset">Reset</a>
				<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-search">Search</a> -->
				<a href="#" class="easyui-linkbutton" onclick="searchData<?=$objectId;?>();" iconCls="icon-reload">Refresh</a>
			  </td>
			</tr>
			</table>
		  </div>
		</td>
	  </tr>
	  </table>
	  
	
<div id="chart1<?=$objectId?>" style="height:350px;width:350px;float:left;color:#FFFFFF"></div> 
<div  style="width:10px;float:left">&nbsp;</div> 
<table id="dg<?=$objectId;?>" class="easyui-datagrid" style="height:auto;width:auto" title="Data Monitoring Checkpoint Kementerian"  fitColumns="false" singleSelect="true" rownumbers="true" pagination="true">
	  <thead>
	  <tr>
		<th field="tahun" sortable="false" width="45">Tahun</th>
		<th field="kode_kl"   sortable="false" width="50">Kode KL</th>
		<th field="nama_kl" align="left" sortable="false" width="200">Nama KL</th>
		<th field="jml_iku" align="right"  sortable="false" width="50">Jml.Iku</th>	
		<th field="sangat_puas" align="center"  sortable="false" width="75">Sangat <br> Memuaskan</th>	
		<th field="puas" align="center"  sortable="false" width="75">Memuaskan</th>	
		<th field="kurang_puas" align="center"  sortable="false" width="75">Kurang <br> Memuaskan</th>	
		<th field="kecewa" align="center"  sortable="false" width="90">Mengecewakan</th>	
	  </tr>
	  </thead> 
	</table>

<script type="text/javascript">
//$.jqplot('chartdiv',  [[[1, 2],[3,5.12],[5,13.1],[7,33.6],[9,85.9],[11,219.9]]]);

$(document).ready(function(){
	

	searchData<?=$objectId;?> = function (){
				//inisialisasi jqplot
							
				var filstart = $("#cmbBulanStart<?=$objectId;?>").val();
				var filend = $("#cmbBulanEnd<?=$objectId;?>").val();				
				var filtahun = $("#filter_tahun<?=$objectId;?>").val();
				var filperiode = $("#cmbPeriode<?=$objectId;?>").val();
				 var objArrayData=[];
				if(filtahun==null) filtahun ="-1";
				if(filperiode==null) filperiode ="-1";
				var pieColor = [ "blue","green","orange","red"];
				$('#chart1<?=$objectId?>').empty();
/*
				if (parseInt(filperiode)==12){
					pieColor = ["green","red"];
					 objArrayData.push(["Memenuhi", parseFloat(0)]);
						  objArrayData.push(["Tidak Memenuhi", parseFloat(0)]);
						  
				}else{
*/
					 objArrayData.push(["Sangat Memuaskan", parseFloat(0)]);
						  objArrayData.push(["Memuaskan", parseFloat(0)]);
						  objArrayData.push(["Kurang Memuaskan", parseFloat(0)]);
						  objArrayData.push(["Mengecewakan", parseFloat(0)]);	
				//}
				
				if (parseInt(filstart)>parseInt(filend)){
					alert("Periode Bulan tidak bisa diproses");
					return;
				}
						
						 
						  var plot1<?=$objectId?> = jQuery.jqplot ('chart1<?=$objectId?>', [objArrayData],
							{
							 height: 50	,
							width: 100,
							  gridPadding: {top:0, bottom:38, left:10, right:0},
							seriesDefaults:{
								renderer:$.jqplot.PieRenderer, 
								trendline:{ show:false }, 
								rendererOptions: { padding: 8, dataLabels:"percent",showDataLabels: true,dataLabelFormatString:'%.2f%' }
							},
							  legend:{
									show:true, 
									placement: 'outside', 
									rendererOptions: {
										numberRows: 1
									}, 
									location:'s',
									marginTop: '15px'
								},    
								seriesColors:pieColor,   
							  series:[{lineWidth:3, markerOptions:{style:'square'}}]
							}); //end inisialisasijqplot
			
				$('#dg<?=$objectId;?>').datagrid({
					url:"<?=base_url()?>checkpoint/monitoring_kl/grid/"+filtahun+"/"+filperiode,
					//queryParams:{lastNo:'0'},	
					pageNumber : 1,
					onLoadSuccess:function(data){	
				//		alert(data.pies);
						 var objArrayData=[];
                var objArray = [];    
						var obj = data.pies;
						 $.each(obj, function(key, value) {
							//   alert(key + ' ' + value);
							  objArrayData.push([key, parseFloat(value)]);
						 });
						// alert(objArrayData);
						 var plot1<?=$objectId?> = jQuery.jqplot ('chart1<?=$objectId?>', [objArrayData],
							{
								 height: 200,
							width: 300,
							  gridPadding: {top:0, bottom:38, left:10, right:0},
								seriesDefaults:{
									renderer:$.jqplot.PieRenderer, 
									//trendline:{ show:false }, 
									rendererOptions: { padding: 8, dataLabels:"percent",showDataLabels: true,dataLabelFormatString:'%.2f%' }
								},
							  legend:{
									show:true, 
									placement: 'outside', 
									rendererOptions: {
										numberRows: 1
									}, 
									location:'s',
									marginTop: '15px'
								},       
								seriesColors:pieColor
							  //series:[{lineWidth:3, markerOptions:{style:'square'}}]
							}    
						  );
						 
						 
						//$('#dg<?=$objectId;?>').datagrid('options').queryParams.lastNo = data.lastNo;
						//prepareMerge<?=$objectId;?>(data);
					}});
					
					plot1<?=$objectId?>.replot();
			}

			
	$.jqplot.postDrawHooks.push(function() {   
			var labels = $('table.jqplot-table-legend tr td.jqplot-table-legend-label');
			 //alert(labels);
			 //$(labels)..css('color',"#000000" );
			 labels.each(function(index) {
					//turn the label's text color to the swatch's color
					//var color = $(swatches[index]).find("div div").css('background-color');
					$(this).css('color',"#000000" );
				//	alert('here');
			 });      
	});


  
  setTimeout(function(){
			searchData<?=$objectId;?>();
			},50);
});


</script>


