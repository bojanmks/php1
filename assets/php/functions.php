<?php
    // UNIVERSAL
    function fetchAllFromDatabase($table) {
        global $connection;
        $query = "SELECT * FROM $table";
        return $connection->query($query)->fetchAll();
    }

    function fetchFromDatabase($query) {
        global $connection;
        return $connection->query($query)->fetchAll();
    }

    // LOGIN
    function userStillExists() {
        if(isset($_SESSION['user'])) {
            if(!userExists($_SESSION['user']->id, 'id')) {
                unset($_SESSION['user']);
            }
        }
    }

    function userExists($value, $column) {
        global $connection;
        $query = "SELECT * FROM users WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $execution->execute();
        $result = $execution->fetch();
        return $result;
    }

    function getUser($email, $password) {
        global $connection;
        $query = "SELECT * FROM users WHERE email = :email AND password = :password";
        $execution = $connection->prepare($query);
        $execution->bindParam(":email", $email);
        $execution->bindParam(":password", $password);
        $execution->execute();
        $result = $execution->fetch();
        return $result;
    }

    function addNewUser($username, $email, $password) {
        global $connection;
        $query = "INSERT INTO users(`username`, `email`, `password`, `role`) VALUES(:username, :email, :password, 1)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':username', $username);
        $execution->bindParam(':email', $email);
        $securePassword = md5($password);
        $execution->bindParam(':password', $securePassword);
        $result = $execution->execute();
        return $result;
    }

    function getRoleName($id) {
        global $connection;
        $query = "SELECT name FROM roles WHERE id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':id', $id);
        $execution->execute();
        $result = $execution->fetch();
        return $result->name;
    }

    // HEADER
    function printNavLinks() {
        $links = fetchAllFromDatabase('pagelinks');
        foreach($links as $link) {
            echo("<li><a href='$link->href' class='font-small'>$link->name</a></li>");
        }
    }

    // FOOTER
    function printFooterSocials() {
        $links = fetchAllFromDatabase('sociallinks');
        foreach($links as $link) {
            echo("<li><a href='$link->href' class='font-small' target='_blank'><i class='$link->icon'></i><span class='socialText'>$link->name</span></a></li>");
        }
    }

    // HOME
    function printSliderImages() {
        $images = fetchAllFromDatabase('sliderimages');
        foreach($images as $image) {
            echo("<div class='slide' style='background-image: url(assets/img/$image->image.jpg)'></div>");
        }
    }

    // DEVICES
    function printChbGroup($label, $table) {
        $values = fetchFromDatabase("SELECT * FROM $table ORDER BY name");
        echo("<div class='formGroup'><label class='font-small'>$label:</label>");
        foreach($values as $value) {
            echo("<div class='checkboxGroup'><input type='checkbox' name='chb$value->name' id='chb$value->name' value='$value->id' class='chb$label filterAction'/><label for='chb$value->name' class='font-small'>$value->name</label></div>");
        }
        echo("</div>");
    }

    function printDevices($devices, $numberOfDevices) {
        if(count($devices) == 0) return('<p class="font-large">Oops. Seems like there are no items that match your search criteria.</p>');
        else {
            $html = '';
            foreach($devices as $device) {
                $html .= "<div class='device'><div class='deviceImage'><img src='assets/img/$device->image' alt='$device->name'/></div><div class='deviceText'><label class='font-medium deviceName'>$device->name</label><label class='font-medium devicePrice'>$device->price"."€"."</label><div class='textCenter'><button class='font-small btnPrimary btnAddToCart' data-id='$device->device_id'><i class='fas fa-shopping-cart font-medium'></i>+</button></div></div></div>";
            }
            // PAGE NAVIGATION
            $numberOfPages = ceil($numberOfDevices/6);
            $html .= "<div id='paging'><ul class='font-small'><li><a href='#' class='btnPrimary prevPage'><</a></li>";
            for($i = 1; $i <= $numberOfPages; $i++) {
                $html .= "<li><a class='btnPrimary btnPage' data-page='$i'>$i</a></li>";
            }
            $html .= "<li><a href='#' class='btnPrimary nextPage'>></a></li></ul></div>";
            return $html;
        }
    }

    // filtering
    function deviceFilteringBindParams($execution) {
        if(isset($_GET['search'])) {
            $searchValue = "%" . $_GET['search'] . "%";
            $execution->bindParam(':search', $searchValue);
        }
        if(isset($_GET['os'])) {
            $osValue = implode(', ', $_GET['os']);
            $execution->bindParam(':os', $osValue);
        }
        if(isset($_GET['brand'])) {
            $brandValue = implode(', ', $_GET['brand']);
            $execution->bindParam(':brand', $brandValue);
        }
        if(isset($_GET['priceRange'])) {
            $execution->bindParam(':price', $_GET['priceRange']);
        }
        return $execution;
    }

    // CONTACT
    function addContactMessage($email, $name, $message) {
        session_start();
        if(isset($_SESSION['user'])) $userId = $_SESSION['user']->id;
        else $userId = NULL;
        global $connection;
        $query = "INSERT INTO contactmessages(`user_id`, `email`, `name`, `message`) VALUES (:userId, :email, :name, :message)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':userId', $userId);
        $execution->bindParam(':email', $email);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':message', $message);
        $result = $execution->execute();
        return $result;
    }

    // AUTHOR
    function printAuthorSocials() {
        $values = fetchAllFromDatabase('authorsocials');
        foreach($values as $value) {
            echo("<li><a href='$value->href' class='font-small' target='_blank'><i class='$value->icon' style='color: $value->color;'></i></a></li>");
        }
    }

    // CART
    function checkout($name, $email, $address, $totalPrice, $details) {
        session_start();
        global $connection;
        $userId = $_SESSION['user']->id;
        $query = "INSERT INTO orders(`user_id`, `buyer_name`, `buyer_email`, `buyer_address`, `total_price`) VALUES (:userId, :name, :email, :address, :totalPrice)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':userId', $userId);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':email', $email);
        $execution->bindParam(':address', $address);
        $execution->bindParam(':totalPrice', $totalPrice);
        $result = $execution->execute();
        if($result) {
            $orderId = $connection->lastInsertId();
            foreach($details as $el) {
                $query = "INSERT INTO orderdetails(`order_id`, `device_id`, `device_price`, `quantity`) VALUES (:orderId, :deviceId, :price, :quantity)";
                $execution = $connection->prepare($query);
                $execution->bindParam(':orderId', $orderId);
                $execution->bindParam(':deviceId', $el['id']);
                $execution->bindParam(':price', $el['price']);
                $execution->bindParam(':quantity', $el['quantity']);
                $result = $execution->execute();
                if(!$result) return false;
            }
            return true;
        } else {
            return false;
        }
    }

    // SURVEY
    function surveyAlreadyCompleted($userId) {
        global $connection;
        $query = "SELECT * FROM survey WHERE user_id = :userId";
        $execution = $connection->prepare($query);
        $execution->bindParam(':userId', $userId);
        $execution->execute();
        $result = $execution->fetch();
        return $result;
    }

    function addSurveyAnswer($userId, $answer) {
        global $connection;
        $query = "INSERT INTO survey(`user_id`, `answer`) VALUES (:userId, :answer)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':userId', $userId);
        $execution->bindParam(':answer', $answer);
        $result = $execution->execute();
        return $result;
    }

    function getSurveyResults($answer) {
        global $connection;
        $query = "SELECT * FROM survey WHERE answer = :answer";
        $execution = $connection->prepare($query);
        $execution->bindParam(':answer', $answer);
        $execution->execute();
        $result = count($execution->fetchAll());
        return $result;
    }

    // ADMIN PAGE
    function redirectTo404() {
        if(!isset($_SESSION['user'])) {
            header('HTTP/1.0 404 Not Found');
            die;
        } else {
            if(getRoleName($_SESSION['user']->role) != 'admin') {
                header('HTTP/1.0 404 Not Found');
                die;
            }
        }
    }

    function printAdminNavLinks() {
        $links = fetchAllFromDatabase('adminnavlinks');
        foreach($links as $link) {
            echo("<li><a href='$link->href' class='font-small'>$link->name</a></li>");
        }
    }

    function printAdminSectionUsers() {
        $users = fetchAllFromDatabase('users');
        $html = "<div id='users' class='adminSection' data-print='print-users.php' data-editform='edit-user-form.php' data-delete='delete-user.php'><div class='heading'><h2 class='font-xl'>Users</h2><span class='underline'><span></div><div class='tableWrapper'><table cellspacing='0' class='table'><thead><tr><td class='colUserId'>ID</td><td class='colUsername'>Username</td><td class='colUserEmail'>Email</td><td class='colRole'>Role</td><td class='colUserActive'>Active</td><td class='colActions'>Actions</td></tr></tdead><tbody>";
        foreach($users as $user) {
            $html .= "
            <tr data-id='$user->id'>
                <td class='colUserId'>$user->id</td>
                <td class='colUsername'>$user->username</td>
                <td class='colUserEmail'>$user->email</td>
                <td class='colRole'>" . getRoleName($user->role) . "</td>
                <td class='colUserActive'>$user->active</td>
                <td class='colActions'>";
                if($_SESSION['user']->id != $user->id) $html .= "<button class='btnEdit btnPrimary font-xs'>Edit</button><button class='btnDelete btnPrimary font-xs'>Delete</button>";
                $html .= "</td></tr>";
        }
        $html .= "</tbody></table></div><button data-form='add-user-form.php' class='btnPrimary btnAdminAdd font-small'>Add new user</button></div>";
        return $html;
    }

    function getValueByColumn($target, $table, $column, $value) {
        global $connection;
        $query = "SELECT $target FROM $table WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $execution->execute();
        $result = $execution->fetchColumn();
        return $result;
    }

    function getOSName($id) {
        return getValueByColumn('name', 'operatingsystems', 'id', $id);
    }

    function getBrandName($id) {
        return getValueByColumn('name', 'brands', 'id', $id);
    }

    function printAdminSectionDevices() {
        $devices = fetchAllFromDatabase('devices');
        $html = "<div id='devices' class='adminSection' data-print='print-devices.php' data-delete='delete-device.php' data-editform='edit-device-form.php'><div class='heading'><h2 class='font-xl'>Devices</h2><span class='underline'><span></div><div class='tableWrapper'><table cellspacing='0' class='table'><thead><tr><td class='colDeviceName'>Name</td><td class='colDeviceImage'>Image</td><td class='colDeviceOS'>OS</td><td class='colDeviceBrand'>Brand</td><td class='colDevicePrice'>Price</td><td class='colDeviceActive'>Active</td><td class='colActions'>Actions</td></tr></tdead><tbody>";
        foreach($devices as $device) {
            $html .= "
            <tr data-id='$device->device_id'>
                <td class='colDeviceName'>$device->name</td>
                <td class='colDeviceImage'>$device->image</td>
                <td class='colDeviceOS'>" . getOSName($device->os) . "</td>
                <td class='colDeviceBrand'>" . getBrandName($device->brand) . "</td>
                <td class='colDevicePrice'>$device->price". "€" . "</td>
                <td class='colDeviceActive'>$device->active</td>
                <td class='colActions'><button class='btnEdit btnPrimary font-xs'>Edit</button><button class='btnDelete btnPrimary font-xs'>Delete</button></td>
            </tr>";
        }
        $html .= "</tbody></table></div><button data-form='add-device-form.php' class='btnPrimary btnAdminAdd font-small'>Add new device</button></div>";
        return $html;
    }

    function printAdminSectionBrands() {
        $brands = fetchAllFromDatabase('brands');
        $html = "<div id='brands' class='adminSection' data-print='print-brands.php' data-delete='delete-brand.php' data-editform='edit-brand-form.php'><div class='heading'><h2 class='font-xl'>Brands</h2><span class='underline'><span></div><div class='tableWrapper'><table cellspacing='0' class='table'><thead><tr><td class='colBrandName'>Name</td><td class='colActions'>Actions</td></tr></tdead><tbody>";
        foreach($brands as $brand) {
            $html .= "
            <tr data-id='$brand->id'>
                <td class='colBrandName'>$brand->name</td>
                <td class='colActions'><button class='btnEdit btnPrimary font-xs'>Edit</button><button class='btnDelete btnPrimary font-xs'>Delete</button></td>
            </tr>";
        }
        $html .= "</tbody></table></div><button data-form='add-brand-form.php' class='btnPrimary btnAdminAdd font-small'>Add new brand</button></div>";
        return $html;
    }

    function printAdminSectionOS() {
        $operatingSystems = fetchAllFromDatabase('operatingsystems');
        $html = "<div id='operatingSystems' class='adminSection' data-print='print-operating-systems.php' data-delete='delete-os.php' data-editform='edit-os-form.php'><div class='heading'><h2 class='font-xl'>Operating systems</h2><span class='underline'><span></div><div class='tableWrapper'><table cellspacing='0' class='table'><thead><tr><td class='colOSName'>Name</td><td class='colActions'>Actions</td></tr></tdead><tbody>";
        foreach($operatingSystems as $os) {
            $html .= "
            <tr data-id='$os->id'>
                <td class='colOSName'>$os->name</td>
                <td class='colActions'><button class='btnEdit btnPrimary font-xs'>Edit</button><button class='btnDelete btnPrimary font-xs'>Delete</button></td>
            </tr>";
        }
        $html .= "</tbody></table></div><button data-form='add-os-form.php' class='btnPrimary btnAdminAdd font-small'>Add new OS</button></div>";
        return $html;
    }

    function printAdminSectionOrders() {
        $orders = fetchAllFromDatabase('orders');
        $html = "<div id='orders' class='adminSection' data-print='print-orders.php' data-delete='delete-order.php' data-editform='edit-order-form.php'><div class='heading'><h2 class='font-xl'>Orders</h2><span class='underline'><span></div><div class='tableWrapper'><table cellspacing='0' class='table'><thead><tr><td class='colOrderUserId'>User ID</td><td class='colBuyerName'>Buyer name</td><td class='colBuyerEmail'>Buyer email</td><td class='colBuyerAddress'>Buyer address</td><td class='colTotalPrice'>Total price</td><td class='colOrderDate'>Date</td><td class='colActions'>Actions</td></tr></tdead><tbody>";
        foreach($orders as $order) {
            $html .= "
            <tr data-id='$order->order_id'>
                <td class='colOrderUserId'>$order->user_id</td>
                <td class='colBuyerName'>$order->buyer_name</td>
                <td class='colBuyerEmail'>$order->buyer_email</td>
                <td class='colBuyerAddress'>$order->buyer_address</td>
                <td class='colTotalPrice'>$order->total_price". "€" . "</td>
                <td class='colOrderDate'>$order->date</td>
                <td class='colActions'><button class='btnEdit btnPrimary font-xs'>Edit</button><button class='btnDelete btnPrimary font-xs'>Delete</button></td>
            </tr>";
        }
        $html .= "</tbody></table></div></div>";
        return $html;
    }

    function printAdminSectionMessages() {
        $messages = fetchAllFromDatabase('contactmessages');
        $html = "<div id='messages' class='adminSection' data-print='print-messages.php' data-delete='delete-message.php'><div class='heading'><h2 class='font-xl'>Messages</h2><span class='underline'><span></div>";
        foreach($messages as $message) {
            $html .= "<div class='messageContainer font-small' data-id='$message->message_id'><span><span class='bold'>User ID: </span>$message->user_id</span><br/><span><span class='bold'>Email: </span>$message->email</span><br/><span><span class='bold'>Name: </span>$message->name</span><br/><span class='bold'>Message:</span><br/><p class='messageContent'>$message->message</p><span><span class='bold'>Date: </span>$message->date</span><br/><button class='btnPrimary btnDeleteMessage btnDelete font-small'>Delete message</button></div>";
        }
        $html .= "</div>";
        return $html;
    }

    function exists($table, $column, $value) {
        global $connection;
        $query = "SELECT * FROM $table WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $execution->execute();
        $result = $execution->fetch();
        return $result;
    }

    // adding
    function adminAddNewUser($username, $email, $password, $role) {
        global $connection;
        $query = "INSERT INTO users(`username`, `email`, `password`, `role`) VALUES(:username, :email, :password, :role)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':username', $username);
        $execution->bindParam(':email', $email);
        $securePassword = md5($password);
        $execution->bindParam(':password', $securePassword);
        $execution->bindParam(':role', $role);
        $result = $execution->execute();
        return $result;
    }

    function addNewDevice($name, $image, $os, $brand, $price) {
        global $connection;
        $query = "INSERT INTO devices(`name`, `image`, `os`, `brand`, `price`) VALUES(:name, :image, :os, :brand, :price)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':image', $image);
        $execution->bindParam(':os', $os);
        $execution->bindParam(':brand', $brand);
        $execution->bindParam(':price', $price);
        $result = $execution->execute();
        return $result;
    }

    function addNewBrand($name) {
        global $connection;
        $query = "INSERT INTO brands(`name`) VALUES(:name)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $result = $execution->execute();
        return $result;
    }

    function addNewOS($name) {
        global $connection;
        $query = "INSERT INTO operatingsystems(`name`) VALUES(:name)";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $result = $execution->execute();
        return $result;
    }

    // editing
    function getInstanceByColumn($table, $column, $value) {
        global $connection;
        $query = "SELECT * FROM $table WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $execution->execute();
        $result = $execution->fetch();
        return $result;
    }

    function getUserById($id) {
        return getInstanceByColumn('users', 'id', $id);
    }

    function getDeviceById($id) {
        return getInstanceByColumn('devices', 'device_id', $id);
    }

    function getBrandById($id) {
        return getInstanceByColumn('brands', 'id', $id);
    }

    function getOSById($id) {
        return getInstanceByColumn('operatingsystems', 'id', $id);
    }

    function getOrderById($id) {
        return getInstanceByColumn('orders', 'order_id', $id);
    }

    function updateDevice($id, $name, $image, $os, $brand, $price, $active) {
        global $connection;
        $query = "UPDATE devices SET name = :name, image = :image, os = :os, brand = :brand, price = :price, active = :active WHERE device_id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':image', $image);
        $execution->bindParam(':os', $os);
        $execution->bindParam(':brand', $brand);
        $execution->bindParam(':price', $price);
        $execution->bindParam(':active', $active);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    function updateBrand($id, $name) {
        global $connection;
        $query = "UPDATE brands SET name = :name WHERE id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    function updateOS($id, $name) {
        global $connection;
        $query = "UPDATE operatingsystems SET name = :name WHERE id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':name', $name);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    function updateOrder($id, $buyerName, $buyerEmail, $buyerAddress) {
        global $connection;
        $query = "UPDATE orders SET buyer_name = :buyerName, buyer_email = :buyerEmail, buyer_address = :buyerAddress WHERE order_id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':buyerName', $buyerName);
        $execution->bindParam(':buyerEmail', $buyerEmail);
        $execution->bindParam(':buyerAddress', $buyerAddress);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    function updateUser($id, $username, $email, $password, $role, $active) {
        global $connection;
        $query = "UPDATE users SET username = :username, email = :email, password = :password, role = :role, active = :active WHERE id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':username', $username);
        $execution->bindParam(':email', $email);
        $securePassword = md5($password);
        $execution->bindParam(':password', $securePassword);
        $execution->bindParam(':role', $role);
        $execution->bindParam(':active', $active);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    function updateUserNoPassword($id, $username, $email, $role, $active) {
        global $connection;
        $query = "UPDATE users SET username = :username, email = :email, role = :role, active = :active WHERE id = :id";
        $execution = $connection->prepare($query);
        $execution->bindParam(':username', $username);
        $execution->bindParam(':email', $email);
        $execution->bindParam(':role', $role);
        $execution->bindParam(':active', $active);
        $execution->bindParam(':id', $id);
        $result = $execution->execute();
        return $result;
    }

    // deleting
    function delete($table, $column, $value) {
        global $connection;
        $query = "DELETE FROM $table WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $result = $execution->execute();
        return $result;
    }

    function setNull($table, $column, $value) {
        global $connection;
        $query = "UPDATE $table SET $column = NULL WHERE $column = :$column";
        $execution = $connection->prepare($query);
        $execution->bindParam(":$column", $value);
        $result = $execution->execute();
        return $result;
    }
?>