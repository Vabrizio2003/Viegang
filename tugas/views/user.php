User Data - <a href="/">Home</a><br/><br/>
<h1>Welcome</h1>
<table>
    <tr>
        <td>Username</td><td> : </td><td><?= $user->getUsername() ?></td>
    </tr>
    <tr>
        <td><img src=<?= $user->getPhoto() ?> alt="photo tidak ditemukan"></td>
    </tr>
    <tr>
    <td>Photo</td><td> : </td><td><?= $user->getPhoto() ?></td>
    </tr>
</table>