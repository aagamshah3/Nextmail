<?php 
include_once("header.php");
$username = $_SESSION['username'];
$password = $_SESSION['password'];
$mailbox_server = "{".$server."}"; //set in headers/header.php



?>
           <div data-role="content">
                <form action="sendmail.php" method="POST" data-ajax="false">
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput6">
                                To
                            </label>
                            <input name="to" id="textinput6" placeholder="To" value="" type="email" />
                        </fieldset>
                    </div>
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textinput7">
                                Subject
                            </label>
                            <input name="subject" id="textinput7" placeholder="Subject" value="" type="text" />
                        </fieldset>
                    </div>
                    <input data-icon="check" data-iconpos="left" value="Send!" type="submit" />
                    <div data-role="fieldcontain">
                        <fieldset data-role="controlgroup">
                            <label for="textarea1">
                            </label>
                            <textarea rows=20 name="body" id="textarea1" placeholder="">	
				

                            </textarea>
                        </fieldset>
                    </div>
                </form>
            </div>


<?php
include_once("footer.php");
?>