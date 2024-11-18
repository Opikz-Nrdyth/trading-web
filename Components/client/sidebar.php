<nav class="bottom-bar bg-primary text-white">
    <a href="/" class="menu-icon text-white">
        <img src="/Assets/Images/home.png" alt="home" height="30px">
        <div><?php echo translate(trim($dataUser["language"]), "Home") ?></div>
    </a>

    <a href="deposit" class="menu-icon text-white">
        <img src="/Assets/Images/deposit.png" alt="home" height="30px">
        <div><?php echo translate(trim($dataUser["language"]), "Deposit") ?></div>
    </a>

    <a href="trade" class="menu-icon trend-icon bg-secondary text-white">
        <img src="/Assets/Images/trade.png" alt="home" height="43px">

    </a>

    <a href="withdraw" class="menu-icon text-white">
        <img src="/Assets/Images/withdraw.png" alt="home" height="30px">
        <div><?php echo translate(trim($dataUser["language"]), "withdraw") ?></div>
    </a>

    <a href="profile" class="menu-icon text-white">
        <img src="/Assets/Images/profile.png" alt="home" height="30px">
        <div><?php echo translate(trim($dataUser["language"]), "Profil") ?></div>
    </a>
</nav>