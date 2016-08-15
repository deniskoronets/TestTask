<?php

use yii\helpers\Url;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Yii2 Authentication task</h1>

       	<p>Authentication based on different roles:</p>

        <a href='<?= Url::to(['admin/login']) ?>' class='btn btn-success'>Login admin</a>
        <a href='<?= Url::to(['sales/login']) ?>' class='btn btn-success'>Login sales</a>
        <a href='<?= Url::to(['site/login', 'pid' => 'RVM1G5621DGYHI']) ?>' class='btn btn-success'>Login with pid</a>
        <a href='<?= Url::to(['site/login']) ?>' class='btn btn-success'>Login</a>

        <hr>

        <p>Access restriction test:</p>
        <a href='<?= Url::to(['admin/index']) ?>' class='btn btn-success'>Only admin</a>
        <a href='<?= Url::to(['sales/index']) ?>' class='btn btn-success'>Only sales + admins</a>
        <a href='<?= Url::to(['site/all-roles']) ?>' class='btn btn-success'>All roles</a>

        <hr>

        <pre class='text-left'>
Need to implement complex multipoint authentication for web application.

Two tables should be used: ‘users’ and ‘as_users’.
Only users with ‘user_type_id’ = 6 from ‘users’ should be used. Users from this table gather role GSM Admin.
For users from ‘as_users’ roles described in ‘as_user_types’ table.

There are 3 entry points for different roles:
1.	/admin/login
2.	/sales/login
3.	/site/login/pid/”hash” (where hash is client specific hash from corresponding table, like - site/login/pid/RVM1G5621DGYHI)

Restrictions by roles:
1.	Only GSM Admins are allowed to login
2.	GSM Admins, Sales Users/Admins, Sales Users/Admins are allowed to login.
3.	All user roles are allowed, but Client Admins are allowed to login only using own client hash (as_clients->hash).
	Any Client Admin has relation to Client table by ‘clientId’ field.

Find in authDB.sql SQL dump for task.
Feel free to use any encrypt password mechanism you prefer. You don’t need to use current password values.

For implementation use PHP 5.x
No any framework restrictions.
		</pre>
    </div>
</div>
