<?php 
    require_once("../../../controllers/adminController.php");
    require_once("../../../controllers/studentController.php");
    require_once("../../../controllers/supervisorController.php");

    $supervisorController = new SupervisorController();
    $studentController = new StudentController();
    $adminController = new AdminController();
    $count = 0;
    $count2 = 0;
    $emailAddress = $_SESSION['email_address'];

    $user = $adminController->getLoggedInUser($emailAddress);
    
    if($user->getAccountType() == "supervisor"){
        $supervisor = $supervisorController->getLoggedInUser($_SESSION["email_address"]);
        $chats = $supervisorController->fetchChatBySupervisorsId($supervisor->getId());
        $tasks = $supervisorController->fetchTasksBySupervisorId($supervisor->getId());

        foreach($chats as $chat){
            $messages = $supervisorController->fetchAllMessagesBySupervisorsId($chat->getId());
            foreach($messages as $message){
                if($message->getUser() != $supervisor->getEmailAddress()){
                    if($message->getStatus() != "seen"){$count = +1;}}
            }
        }
    
        foreach($tasks as $task){
            if($task->getRating() == "" && $task->getSupervisorComment() == "" && $task->getStatus() == "completed"){
                $count2++;
            }
        }
    }

?>
<header class="header">
    <div class="container-fluid">
        <div class="row">
        <div class="col-lg-5 col-md-5 col-6">
            <div class="header-left d-flex align-items-center">
            <div class="menu-toggle-btn mr-20">
                <button
                id="menu-toggle"
                class="main-btn primary-btn btn-hover"
                >
                <i class="lni lni-chevron-left me-2"></i> Menu
                </button>
            </div>
            <div class="header-search d-none d-md-flex">
                <form action="#">
                <input type="text" placeholder="Search..." />
                <button><i class="lni lni-search-alt"></i></button>
                </form>
            </div>
            </div>
        </div>
        <div class="col-lg-7 col-md-7 col-6">
            <div class="header-right">
            <!-- notification start -->
            <div class="notification-box ml-15 d-none d-md-flex">
                <button class="dropdown-toggle" type="button" id="notification" data-bs-toggle="dropdown" aria-expanded="false">
                <i class="lni lni-alarm"></i>
                    <?php if($user->getAccountType() == "supervisor"){if($count2 > 0){echo '<span>'.$count2.'</span>';}}?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="notification">
                    <?php 
                    $isEmpty = false;
                        foreach($tasks as $task){
                            if($task->getRating() == "" && $task->getSupervisorComment() == "" && $task->getStatus() == "completed"){
                                echo '
                                <li>
                                    <a href="../../supervisor/tasks/comment-rate-form.php?id='.$task->getId().'">
                                    <div class="content">
                                        <h6>
                                        '.$task->getName().'
                                        <span class="text-regular">
                                            task done click to comment and rate
                                        </span>
                                        </h6>
                                        <p>
                                        '.$task->getStatus().'
                                        </p>
                                        <span>'.$task->getTimestamp().'</span>
                                    </div>
                                    </a>
                                </li>
                                ';
                                $isEmpty = false;
                            }
                        }
                        if($isEmpty){
                                echo '
                                <li>
                                    <a href="#0">
                                    <div class="content">
                                        <h6>
                                            No Notifications
                                        </h6>
                                    </div>
                                    </a>
                                </li>
                            ';              
                        }
                    ?>
                </ul>
            </div>
            <!-- notification end -->
            <!-- message start -->
            <div class="header-message-box ml-15 d-none d-md-flex">
                <button
                class="dropdown-toggle"
                type="button"
                id="message"
                data-bs-toggle="dropdown"
                aria-expanded="false"
                >
                <i class="lni lni-envelope"></i>
                <?php 
                    if($user->getAccountType() == "supervisor"){if($count>0){echo'<span>'.$count.'</span>';}}
                ?>
                </button>
                <ul class="dropdown-menu" aria-labelledby="message">
                    <?php 
                    if($user->getAccountType() == "supervisor"){
                        foreach($chats as $chat){
                            $messages = $supervisorController->fetchAllMessagesBySupervisorsId($chat->getId());
                            foreach($messages as $message){
                                if($message->getUser() != $supervisor->getEmailAddress()){
                                    if(strlen($message->getMessage())>120){
                                        $message->setMessage(substr($message->getMessage(),0,75));
                                    }
                                    if($message->getStatus() != "seen"){
                                        echo '
                                        <li>
                                            <a href="../../supervisor/messages/mark-as-read.php?id='.$message->getId().'">
                                            <div class="image">
                                                <img src="../../../assets/images/lead/lead-5.png" alt="" />
                                            </div>
                                            <div class="content">
                                                <h6>'.$message->getUser().'</h6>
                                                <p>'.$message->getMessage().'<b>....</b></p>
                                                <span>'.$message->getTimestamp().'</span>
                                            </div>
                                            </a>
                                        </li>
                                        ';
                                    }else{
                                        echo '
                                        <li>
                                            <a href="#">
                                            <div class="content">
                                                <h6>No latest Messages</h6>
                                            </div>
                                            </a>
                                        </li>
                                        ';
                                        break;
                                    }
                                }
                            
                            }
                        }
                    }
                    ?>
                </ul>
            </div>
            <!-- message end -->

            <?php 
                if($user->getAccountType() == "supervisor"){
                    echo '
                                <!-- profile start -->
                        <div class="profile-box ml-15">
                            <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            <div class="profile-info">
                                <div class="info">
                                <h6>'.$user->getEmailAddress().'</h6>
                                <div class="image">
                                    <img
                                    src="../../../assets/images/profile/profile-image.png"
                                    alt=""
                                    />
                                    <span class="status"></span>
                                </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                            <li>
                                <a href="../../supervisor/profile/profile.php">View Profile</a>
                            </li>
                            <li>
                                <a href="../../supervisor/messages/messages.php">Messages</a>
                            </li>
                            <li>
                                <a href="../../auth/signout.php">Sign Out</a>
                            </li>
                            </ul>
                        </div>
                        <!-- profile end -->
                    ';
                }elseif($user->getAccountType() == "student"){
                    echo '
                                <!-- profile start -->
                        <div class="profile-box ml-15">
                            <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            <div class="profile-info">
                                <div class="info">
                                <h6>'.$user->getEmailAddress().'</h6>
                                <div class="image">
                                    <img
                                    src="../../../assets/images/profile/profile-image.png"
                                    alt=""
                                    />
                                    <span class="status"></span>
                                </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                            <li>
                                <a href="#0">View Profile</a>
                            </li>
                            <li>
                                <a href="#0">Notifications</a>
                            </li>
                            <li>
                                <a href="../../auth/signout.php">Sign Out</a>
                            </li>
                            </ul>
                        </div>
                        <!-- profile end -->
                    ';
                }elseif($user->getAccountType() == "assessor"){
                    echo '
                                <!-- profile start -->
                        <div class="profile-box ml-15">
                            <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            <div class="profile-info">
                                <div class="info">
                                <h6>'.$user->getEmailAddress().'</h6>
                                <div class="image">
                                    <img
                                    src="../../../assets/images/profile/profile-image.png"
                                    alt=""
                                    />
                                    <span class="status"></span>
                                </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                            <li>
                                <a href="#0">View Profile</a>
                            </li>
                            <li>
                                <a href="#0">Messages</a>
                            </li>
                            <li>
                                <a href="../../auth/signout.php">Sign Out</a>
                            </li>
                            </ul>
                        </div>
                        <!-- profile end -->
                    ';
                }elseif($user->getAccountType() == "admin"){
                    echo '
                                <!-- profile start -->
                        <div class="profile-box ml-15">
                            <button
                            class="dropdown-toggle bg-transparent border-0"
                            type="button"
                            id="profile"
                            data-bs-toggle="dropdown"
                            aria-expanded="false"
                            >
                            <div class="profile-info">
                                <div class="info">
                                <h6>'.$user->getEmailAddress().'</h6>
                                <div class="image">
                                    <img
                                    src="../../../assets/images/profile/profile-image.png"
                                    alt=""
                                    />
                                    <span class="status"></span>
                                </div>
                                </div>
                            </div>
                            <i class="lni lni-chevron-down"></i>
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="profile">
                            <li>
                                <a href="#0">View Profile</a>
                            </li>
                            <li>
                                <a href="../../auth/signout.php">Sign Out</a>
                            </li>
                            </ul>
                        </div>
                        <!-- profile end -->
                    ';
                }
            ?>

            </div>
        </div>
        </div>
    </div>
    </header>
    