<div class="products-area-wrapper tableView tablechat" id='inbox' style='display:none'>
                <div class="spliter">
                <?php
                    // Assuming you have a database connection established
                    $con = mysqli_connect("localhost", "root", "", "taskbuddynw") or die("Could not connect to the database");
                    if (mysqli_connect_errno() || !$con) {
                        echo "Failed to connect to MySQL: " . mysqli_connect_error();
                    } else {
                            
                            $sql = "SELECT
                            MAX(pi.image_url) AS image_url,
                            MAX(m.msg) AS message,
                            MAX(m.created_at) AS created_at,
                            pim.post_id AS post_id,
                            MAX(pim.outgoing_id) AS user_id1,
                            MAX(pim.incoming_id) AS user_id2,
                            MAX(u.fullname) AS username1,
                            MAX(u2.fullname) AS username2,
                            MAX(p.title) AS post_title
                        FROM
                            post_id_messages AS pim
                        
                        INNER JOIN
                            posts AS p ON pim.post_id = p.id
                        LEFT JOIN
                            post_images AS pi ON p.id = pi.post_id
                        LEFT JOIN
                            messages AS m ON (
                                (m.incoming_msg_id = pim.incoming_id AND m.outgoing_msg_id = pim.outgoing_id)
                                OR
                                (m.incoming_msg_id = pim.outgoing_id AND m.outgoing_msg_id = pim.incoming_id)
                            )
                        INNER JOIN
                            users AS u ON u.id =pim.outgoing_id
                        INNER JOIN
                            users AS u2 ON u2.id =pim.incoming_id
                        WHERE
                            (pim.outgoing_id = ? OR pim.incoming_id = ?)
                        GROUP BY
                            pim.post_id
                        ORDER BY
                            MAX(m.created_at) DESC;
                            ";

                            // Create a prepared statement
                        $stmt = $con->prepare($sql);

                        if ($stmt) {
                            // Bind the parameter (user ID from the session)
                            $stmt->bind_param("ii", $_SESSION['id'], $_SESSION['id']);

                            // Execute the statement
                            $stmt->execute();

                            // Get the result set
                            $result = $stmt->get_result();
                                                            

                            // Check if there are any products in the database
                            if (mysqli_num_rows($result) > 0) {
                                // Loop through the products and generate rows
                                while ($row = mysqli_fetch_assoc($result)) {
                                    if (empty($row['image_url']))
                                        $img_path = "assets/user_images/user_icon_df.png";
                                    else
                                        $img_path= $row['image_url'];  
                        
                                    // Add a unique identifier (e.g., user ID) to each product-cell
                                    if($_SESSION['id']==$row['user_id1'] && $_SESSION['username']!=$row['username1']){
                                        echo '<div class="products-row chat" id="senderUser" user="'.$row['user_id2'].'" post="'.$row['post_id'].'" >';
                                        echo '<h6>'.ucfirst($row['username2']).'</h6>';
                                    }
                                    else{
                                        echo '<div class="products-row chat" id="senderUser" user="'.$row['user_id1'].'" post="'.$row['post_id'].'" >';
                                        echo '<h6>'.ucfirst($row['username1']).'</h6>';
                                    }


                                    echo '<div class="product-cell image"> <img src=' . ltrim($img_path,'./') . ' alt="post"><span class="user-name">' . ucfirst($row['post_title']) . '</span></div></div>';
                                }
                            }
                        }
                    }
                ?>
                </div>
                <div class="chat-container">
                    <div class="chat-messages" id="chat-messages"></div>
                    <div class="chat-suggestions"  style='display:none'>
                        <?php
                        // Example suggestion array (replace with your suggestions)
                        $suggestions = array("Γειά!", "Πώς μπορώ να βοηθήσω;", "Πες μου περισσότερα.", "Ενδιαφέρον.");

                        // Loop through suggestions and generate bubbles
                        foreach ($suggestions as $suggestion) {
                            echo '<div class="suggestion-bubble">' . $suggestion . '</div>';
                        }
                        ?>
                    </div>
                    <div class="chat-input">
                        <input type="text" id="message-input" placeholder="Type your message">
                        <button id="send-button">Send</button>
                    </div>
                </div>
            </div>


