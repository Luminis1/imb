<h3>Choose date</h3>

<form method="post" action="/index/priceByDate">
    <input type="date" name="date">
    <br>
    <br>
    <input type="submit">
</form>
<br>
<?php if(!empty($obj)): ?>

    <table>
        <thead>
            <tr>
                <td> Наименование </td>
                <td> Описание </td>
                <td> Номер документа </td>
                <td> Дата  документа </td>
                <td> Цена </td>
            </tr>
        </thead>
    <?php foreach ($obj as $k => $v): ?>
        <tbody>
        <td><?php echo $v['title'] ?></td>
        <td><?php echo $v['description'] ?></td>
        <td><?php echo $v['id'] ?></td>
        <td><?php echo $v['datetime'] ?></td>
        <td><?php echo $v['price'] ?></td>
        </tbody>
    <?php endforeach; ?>
    </table>

<?php endif; ?>