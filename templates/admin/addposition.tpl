<div class="content">
<h1>{$smarty.const.ELECTION_NAME}</h1>
</div>
{errors}
<div class="content error">
{errors all='error'}
	{$error}<br />
{/errors}
</div>
{/errors}
<div class="content">
<h2>Add Position</h2>
<form action="addposition.do">
<table>
	<tr>
		<td>Position: <span style="color:red;">*</span></td>
		<td><input type="text" name="position" /></td>
	</tr>
	<tr>
		<td>
			Maximum: <span style="color:red;">*</span>
			<br />
			<span class="grayed">
			(maximum no. of candidates that can be accepted for this position, e.g. you can accept only 3 possible councilors out of 12 candidates)
			</span>
		</td>
		<td><input type="text" name="maximum" /></td>
	</tr>
	<tr>
		<td>
			Order<span style="color:red;">*</span>
			<br />
			<span class="grayed">
			(refers to the how the positions will be displayed, e.g. President can have an order of 1, Vice-President has an order of 2, etc)
			</span>
		</td>
		<td><input type="text" name="ordinality" /></td>
	</tr>
	<tr>
		<td>Description:</td>
		<td><textarea name="description"></textarea></td>
	</tr>
	<tr>
		<td>Abstain: <span style="color:red;">*</span></td>
		<td><input type="radio" name="abstain" value="`$smarty.const.YES`" /> enable <input type="radio" name="abstain" value="`$smarty.const.NO`" /> disable</td>
	</tr>
	{if $smarty.const.ELECTION_UNIT|lower eq "enable"}
	<tr>
		<td>
			Unit: <span style="color:red;">*</span>
			<br />
			<span class="grayed">
			(voter-dependent position, e.g. a voter from Computer Science can only see and vote a Computer Science Representative)
			</span>
		</td>
		<td><input type="radio" name="unit" value="`$smarty.const.YES`" /> yes <input type="radio" name="unit" value="`$smarty.const.NO`" /> no</td>
	</tr>
	{/if}
	<tr>
		<td></td>
		<td><input type="submit" value="Add Position" /></td>
	</tr>
	<tr>
		<td colspan="2"><span style="color:red;">* -required fields</span></td>
	</tr>
</table>
</form>
<p>back to <a href="positions">positions</a></p>
</div>