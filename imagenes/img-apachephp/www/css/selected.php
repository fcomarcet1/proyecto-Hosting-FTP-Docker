
$result = mysql_query("SELECT * FROM users WHERE `id`!='".$user_id."'");
while ($row = mysql_fetch_array($result))
{
    if ($_GET['to'] == $row['id'])
    {
        $selected = 'selected="selected"';
    }
    else
    {
    $selected = '';
    }
    echo('<option value="'.$row['id'].' '.$selected.'">'.$row['username'].' ('.$row['fname'].' '.substr($row['lname'],0,1).'.)</option>');
}