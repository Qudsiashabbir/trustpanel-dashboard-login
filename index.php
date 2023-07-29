<?php 
    include('./Shared/Components/layout.start.php');
?>


        <div class="container">
            <div class="row">
                <div class="card">
                    <div class="container">
                        <div class="row" id="btn-container">
                            <div class="col-md-3">
                                <button class="btn btn-theme" onclick="showForm('Instagram')">Instagram</button>
                            </div>
                        </div>
                        
                        <button onclick="showForm('Facebook')">Facebook</button>
                        <button onclick="showForm('Youtube')">Youtube</button>
                        <button onclick="showForm('Twitter')">Twitter</button>
                        <button onclick="showForm('Spotify')">Spotify</button>
                        <button onclick="showForm('Tiktok')">Tiktok</button>
                        <button onclick="showForm('Linkedin')">Linkedin</button>
                        <button onclick="showForm('Google')">Google</button>
                        <button onclick="showForm('Telegram')">Telegram</button>
                        <button onclick="showForm('Discord')">Discord</button>
                        <button onclick="showForm('Snapchat')">Snapchat</button>
                        <button onclick="showForm('Twitch')">Twitch</button>
                        <button onclick="showForm('Website Traffic')">Website Traffic</button>
                        <button onclick="showForm('Reviews')">Reviews</button>
                        <button onclick="showForm('Other')">Other</button>
                        <button onclick="showForm('Everything')">Everything</button>
                    </div>
                </div>
            </div>
            
            <div class="form-container" id="formContainer">
              <form action="mailto:qudsia.shabbir32@gmail.com" method="post" enctype="text/plain">
                <label for="buttonText">Selected Button Text:</label>
                <input type="text" id="buttonText" name="buttonText" readonly>
          
                <label for="platformService">Platform Service:</label>
                <select id="platformService" name="platformService">
                  <!-- The default option, other options will be added dynamically -->
                  <option value="" disabled selected>Select a service...</option>
                </select>
          
                <label for="range">Number of Services (50-2500):</label>
                <input type="number" id="range" name="range" min="50" max="2500" required>
          
                <button type="submit">Submit</button>
              </form>
            </div>
        </div>

<?php 
    include('./Shared/Components/layout.end.php');
?>

<?php
include('./Shared/Components/end.php');
?>