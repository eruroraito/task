<table>
<tr>
<td>
<asp:FileUpload ID="BtnUpload" runat="server" onchange="onFilechange()" />
</td>
</tr>
<tr>
<td>
<img id="ImagePhoto" alt="" src="" height="100px" width="100px" />

<div id="pic" runat="server" style="filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod=scale);
width: 100px; height: 100px; display: none">
</div>

<asp:Button ID="Button1" runat="server" Text="上传" />
</td>
</tr>
<tr>
<td>
</td>
</tr>
</table>


<script language="javascript" type="text/javascript">
function onFilechange() {
var url = $("#BtnUpload").attr("value");
$("#ImagePhoto").css("width", "0");
$("#ImagePhoto").css("height", "0");
$("#pic").css("display", "block");
document.getElementById("pic").filters.item("DXImageTransform.Microsoft.AlphaImageLoader").src = url;
}
</script>