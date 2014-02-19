<!-- Center -->
<div id="center_column" class="center_column">
    <br />
        <h1>Messages</h1>
        <br />
        <table class="cart-list">
            <tr>
                <th>Message title</th>
                <th>Message text</th>
            </tr>
        <:iteration name="tableRows">
            <tr>
                <td>
                <span class="msg_title"><:CustomerMessageTitle:></span>
                </td>
                <td>
                <div class="msg_text"><:CustomerMessageText:></div>
                </td>
            </tr>
        <:enditeration name="tableRows">
        </table>
    </div>
<div id="columns_bottom"></div>
</div>
<script type="text/javascript">

</script>