    <section class="suggestion">
    	<form action="question_scan/doAudit" method="post" id="suggestion_form">
	    	<h3>审核不通过(意见)</h3>
	    	<input type="hidden" name="audit" value="1" />
	    	<input type="hidden" name="id" value=<?php echo $edit['id'];?> />
	    	<input type="hidden" name="type" value=<?php echo $edit['type'];?> />
	    	<textarea class="suggestion" maxlength="200" name="suggestion"></textarea>
	    	<br />
	    	<input type="submit" value="确定审核" class="suggestion" />
   		</form>
    </section>