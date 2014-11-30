<?php
if(!defined('ABSPATH')) die('Direct Access is not Allowed!'); 
global $wpdb;
$limit = 10;

 
$start = isset($_GET['paged'])?(($_GET['paged']-1)*$limit):0;
$contact_table_name = $wpdb->prefix . "contact";

$res = $wpdb->get_results("select * from $contact_table_name order by id desc limit $start, $limit",ARRAY_A);

$row = $wpdb->get_row("select count(*) as total from $contact_table_name",ARRAY_A);
?>
 

<div class="wrap">
    <div class="icon32" id="icon-upload"><br></div>
    
<h2>Contact Entries
</h2>
<div style="position: absolute;right:10px;margin-top: 5px;">
<form action="" method="get">
 <input type="hidden" name="page" value="contact-list" />
 <input type="text" name="s" id="s" value="<?php echo isset($_GET['s'])?$_GET['s']:''; ?>" />
 <input type="submit" class="button-primary action" id="doaction" name="doaction" value="Search">
 </form>
</div>
           
<form method="get" action="" id="posts-filter">
<div class="tablenav">

<div class="alignleft actions">
<select class="select-action" name="task">
<option selected="selected" value="-1">Bulk Actions</option>
<option value="DeleteContact">Delete Permanently</option>
</select>

<input type="submit" class="button-secondary action" id="doaction" name="doaction" value="Apply">
 

</div>
<br class="clear">
</div>

<div class="clear"></div>

<table cellspacing="0" class="widefat fixed">
    <thead>
    <tr>
        <th>Id</th>
        <th>Name</th>
        <th>Email</th>
        <th>Phone</th>
        <th>Message</th>
        <th>Added Date</th>
    </tr>
    </thead>

    <tbody class="list:post" id="the-list">
    <?php foreach($res as $designRow) {
        ?>
    <tr valign="top" class="alternate author-self status-inherit" id="post-8">

                <th class="check-column" scope="row"><input type="checkbox" value="<?php echo $designRow['id']?>" name="id[]"></th>
                        <td class="author column-author"><?php echo $designRow['name']; ?></td>
                        <td class="author column-author"><?php echo $designRow['email']; ?></td>
                        <td class="author column-author"><?php echo $designRow['phone']; ?></td>
                        <td class="author column-author"><?php echo $designRow['message']; ?></td>
                        <td class="author column-author"><?php echo $designRow['added_timestamp']; ?></td>
     </tr>
     <?php } ?>
    </tbody>
</table>

<?php
$paged = isset($_GET['paged']) ?$_GET['paged'] :1;

$page_links = paginate_links( array(
    'base' => add_query_arg( 'paged', '%#%' ),
    'format' => '',
    'prev_text' => __('&laquo;'),
    'next_text' => __('&raquo;'),
    'total' => ceil($row['total']/$limit),
    'current' => $paged
));


?>

<div id="ajax-response"></div>

<div class="tablenav">

<?php 
if ( $page_links ) { 
                
    ?>
<div class="tablenav-pages"><?php $page_links_text = sprintf( '<span class="displaying-num">' . __( 'Displaying %s&#8211;%s of %s' ) . '</span>%s',
    number_format_i18n( ( $paged - 1 ) * $limit + 1 ),
    number_format_i18n( min( $paged * $limit, $row['total'] ) ),
    number_format_i18n( $row['total'] ),
    $page_links
); echo $page_links_text; ?></div>
<?php } ?>

<div class="alignleft actions">
<select class="select-action" name="action2">
<option selected="selected" value="-1">Bulk Actions</option>
<option value="DeleteContact">Delete Permanently</option>
</select>
<input type="submit" class="button-secondary action" id="doaction2" name="doaction2" value="Apply">

</div>

<br class="clear">
</div>
   
</form>
<br class="clear">

</div>

 
