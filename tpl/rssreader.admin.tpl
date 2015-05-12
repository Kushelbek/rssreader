<!-- BEGIN: ADMIN -->
<script type="text/javascript">
	var num = {CATNUM};
	function removequest(object)
	{
		$(object).closest('tr.catrow').remove();
		changecats();
		return false;
	}
	function changecats()
	{
		var newstext='';
		for (var i=1; i<=num; i++)
		{
			
			var mycat = $('#cay_'+i).val();
			var mycatn = $('#can_'+i).val();
			if($('#cat_'+i).length && mycat!='' && mycatn!='')
			{
				$('#cag_'+i).html(('{'+'PHP.RSSREADER.'+mycatn+'}').toUpperCase());
				$('#caf_'+i).html('rssreader.'+mycatn+'.tpl');
				newstext += mycatn;
				newstext +='|' + mycat;
				newstext += '|'+$('#cac_'+i).val();
				newstext += '|'+$('#cam_'+i).val();
				if ($('#cah_'+i).attr('checked'))
					newstext += '|1';
				else newstext += '|0';
				newstext += '\n';
			}
			else
			{
				$('#cag_'+i).html('');
				$('#caf_'+i).html('');
			}
		}
		$('[name=category]').val(newstext);
	}
	$(document).ready(function(){
		$("#cat_new").hide();
		$("#catgenerator").show();
		$('[name=category]').insertBefore('#addoption');
		$('[name=x]').insertBefore('#addoption');
		$('[name=category]').hide();
		$('#catgenerator').parents('form#saveconfig').html($('#catgenerator').html());
		$('#cac_new').val($('[name=maxpages]').val());
		$('[name=category]').width('100%');
		$('[name=cay]').width('200px');
		changecats();
		$('[name=cah]').click(function(){ changecats(); });
		$('input').change(function(){ changecats(); });
		$('#addoption').click(function(){
			var allfields = true;
			for (var i=1; i<=num; i++)
			{

				var mycat=$('#cay_'+i).val();
				var mycatn = $('#can_'+i).val();
				if($('#cat_'+i).length && (mycat=='' || mycatn==''))
				{
					allfields = false;
				}
			}
			if (allfields)
			{
				num++;
				var object = $('#cat_new').clone().attr("id", 'cat_'+num);
				$(object).find('#can_new').attr("id", 'can_'+num);
				$(object).find('#cay_new').attr("id", 'cay_'+num);
				$(object).find('#cac_new').attr("id", 'cac_'+num);
				$(object).find('#cag_new').attr("id", 'cag_'+num);
				$(object).find('#caf_new').attr("id", 'caf_'+num);
				$(object).find('#cam_new').attr("id", 'cam_'+num);
				$(object).find('#cah_new').attr("id", 'cam_'+num);
				$(object).insertBefore('#addtr').show();
				$('input').change(function(){ changecats(); });
				$('[name=cah]').change(function(){ changecats(); });
				changecats();
			}
			else
			{
				alert("error");
			}
		});
	});
</script>

<div id="catgenerator">

<h2 class="page"><a href="admin.php?m=config&n=edit&o=plug&p=rssreader">RSS Reader Plugin</a></h2>

	<table class="cells">
		<tr>
			<td class="coltop width10">{PHP.L.Code}</td>
			<td class="coltop width25">{PHP.L.Rssfeedurl}</td>
			<td class="coltop width5">{PHP.L.Count}</td>
			<td class="coltop width15">{PHP.L.Charset}</td>
			<td class="coltop width10">HTML *</td>
			<td class="coltop width10">{PHP.L.Tag}</td>
			<td class="coltop width15">{PHP.L.Template} **</td>
			<td class="coltop width10">{PHP.L.Action}</td>
		</tr>

		<!-- BEGIN: RSS -->
		<tr id="cat_{ADDNUM}" class="catrow">
			<td class="centerall">
				<input type="text" class="text" name="can" id="can_{ADDNUM}" value="{ADDNAME}" size="6" maxlength="10" />
			</td>
			<td class="centerall">
				<input type="text" class="text" name="cay" id="cay_{ADDNUM}" value="{ADDURL}" size="32" maxlength="255" />
			</td>
			<td class="centerall">
				<input type="text" class="text" name="cac" id="cac_{ADDNUM}" value="{ADDCOUNT}" size="3" maxlength="255" />
			</td>
			<td class="centerall">
				<input type="text" class="text" name="cac" id="cam_{ADDNUM}" value="{ADDCHARSET}" size="12" maxlength="255" />
			</td>
			<td class="centerall">
				<input type="checkbox" class="cam" name="cam" id="cah_{ADDNUM}" value="1"<!-- IF {ADDHTML} == 1 --> checked="checked"<!-- ENDIF --> /></td>
			<td class="cat_desc centerall">
				<span id="cag_{ADDNUM}">&nbsp;</span>
			</td>
			<td class="cat_desc centerall">
				<span id="caf_{ADDNUM}">&nbsp;</span>
			</td>
			<td class="centerall">
				<button type="button" onclick='removequest(this)'title="{PHP.L.Delete}">{PHP.L.Delete}</button>
			</td>
		</tr>
		<!-- END: RSS -->
		<tr id="addtr">
			<td colspan="7"></td>
			<td class="centerall"><button name="addoption" id="addoption" type="button">{PHP.L.Add}</button></td>
		</tr>
	</table>

	<div class="centerall padding10"><button type="submit">{PHP.L.Update}</button></div>

</div>
<!-- END: ADMIN -->