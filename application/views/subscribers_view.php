<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <style type="text/css">
            *{
                font-size:  12px;
                font-family: arial;
            }
            table{
                border-collapse: collapse;
            }
            td,th{
                border: 1px solid #666666;
                padding: 4px;
            }
            div{
                padding: 4px;
            }

        </style>
    </head>
    <body>
        <div>Found: <?= $total_rows ?></div>
        <table>
            <thead>
            <th><a href="http://localhost/ci/subscribers/display/first_name/<?= ($sort_order == 'desc') ? 'asc' : 'desc'; ?>">First Name</a></th>
            <th><a href="http://localhost/ci/subscribers/display/last_name/<?= ($sort_order == 'desc') ? 'asc' : 'desc'; ?>">Last Name</a></th>
            <th><a href="http://localhost/ci/subscribers/display/email/<?= ($sort_order == 'desc') ? 'asc' : 'desc'; ?>">Email Name</a></th>
        </thead>

        <tbody>
            <?php
            foreach ($rows as $row):
                ?>
                <tr>
                    <td><?= $row->first_name ?></td>
                    <td><?= $row->last_name; ?></td>
                    <td><?= $row->email; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>

    </table>
    <div id="pagination"> <?= $pagination; ?>
    </div>
</body>
</html>
