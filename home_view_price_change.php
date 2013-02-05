<?php
/*
 * @auther udzhou
 * @date 2013 2-4
 */
require_once 'class/goods_service.class.php';
require_once 'class/goods.class.php';
$pageCurrent=1; 	
$goods_service=new GoodsService();
$page_size=$goods_service->getListRows();
$array_goods=$goods_service->listAll($pageCurrent,$page_size);
?>
<ul class="nav nav-tabs" id="myTab">
  <li><a href="./index.php?mod=home&action=latest_problem">最新问题</a></li>
  <li class="active"><a href="./index.php?mod=home&action=price_change">价格变化</a></li>
</ul> 
<div class="tab-content">
  <div class="tab-pane active" id="latest_problem">

  	<div class="control-group">
  	<label class="control-label" for="goods_id">请选择产品</label>
    <div class="controls">
      <select id="goods_id" name="goods_id">
      <?php 
        foreach ($array_goods as $goods){      
        echo "
        <option value='$goods->id'>$goods->goods_name</option> ";
        }       
      ?>          
      </select>
    </div>
     <div class="controls">
      <select id="time_range" name="time_range">     
        <option value='7'>最近一周</option>
        <option value='30'>最近一个月</option>
        <option value='90'>最近三个月</option>
      </select>
    </div>
	</div>

<table class="table table-bordered table-striped  table-hover" id="price_change">
  <caption>价格变化趋势</caption>
  <thead>
      <tr>
        <th>产品名称</th>
        <th>产品价格</th>
        <th>更新时间</th>                   
      </tr>
    </thead>
    <tbody>
     
      
    </tbody>
  </table>

  </div>    
</div>
<script type="text/javascript">
function getGoodsPrice(){   
  var goods_name=$("#goods_id").find("option:selected").text();  
  $.ajax({
    type: "POST",
    url: "goods_price_change.php",
    timeout:20*1000,
    dataType: "json", 
    data: {"goods_id":$('#goods_id').val(),"time_range":$('#time_range').val()},
    success:function(price_change){          
      for(var i in price_change){
        var price_table=document.getElementById('price_change').insertRow(1);       
        price_table.insertCell(0).innerHTML=goods_name;
        price_table.insertCell(1).innerHTML=price_change[i].price;
        price_table.insertCell(2).innerHTML=price_change[i].modified;
        //alert(price_change[i].price);
      }
    },
    error:function(){

    }
    });
}
$(document).ready(function(){
  getGoodsPrice();
  $('#goods_id').change(function(){
    var price_table=document.getElementById('price_change');
    while(price_table.rows.length>1){
      price_table.deleteRow(price_table.rows.length-1);
    }
    getGoodsPrice();
  });  
});
  
</script>