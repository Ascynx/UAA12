<?php
$actualPage = $page + 1;
$min = $page * 10;
$max = $min + 10;
?>

<link rel="stylesheet" href="Assets/css/loggedIn.css">

<div class="table flex column scroll-overflow">
    <table class="flex center-self">
        <tr class="table-header">
            <th>Id</th>
            <th>Nom d'utilisateur</th>
            <th>Email</th>
            <th>Niveau d'accès</th>
        </tr>
        <?php
            $pagedElements = getAllUsersFromTo($min, $max);
            for ($i = 0; $i < sizeof($pagedElements); $i++) {
                $element = $pagedElements[$i];

                $id = $element->user_id;
                $username = $element->user_name;
                $email = $element->user_email;
                $access = $element->user_access;
                $stringAccess = getStringAccessFrom($access)->name;


                if ($user["user_access"] >= 2) {
                    echo("
                        <tr>
                            <td>
                                $id
                            </td>
                            <td>
                                $username
                            </td>
                            <td>
                                $email
                            </td>
                            <td>
                                $stringAccess
                            </td>
                            <td class=\"highlightOnHover clickable\">
                            <span class=\"edit smaller-img-container inherit-display\" onclick=\"redirectTo('/profil?editUser=$id')\">
                                <img src=\"/Assets/images/pencil.png\" alt=\"edit\">
                            </span>
                        </td>
                        <td class=\"highlightOnHover clickable\">
                            <span class=\"delete smaller-img-container inherit-display\" onclick=\"redirectTo('/deladmin?userId=$id')\">
                                <img src=\"/Assets/images/trash-can.png\" alt=\"delete\">
                            </span>
                        </td>
                        </tr>
                    ");
                }
            }
        ?>
    </table>
</div>

<script src="/Assets/scripts/utils.js"></script>
<script src="/Assets/scripts/loggedIn.js"></script>