<?php
    if(isset($_SESSION['user'])):
        if(!isset($_SESSION['user']->preventSurvey)):
?>
    <div id="survey">
        <div class="container">
            <?php
                if(!surveyAlreadyCompleted($_SESSION['user']->id)):
            ?>
            <span class="font-small bold">How would you rate our service?</span>
            <form>
                <div class="surveyChoices">
                    <?php
                        for($i = 1; $i <= 5; $i++):
                    ?>
                    <div class="surveyRadioButton">
                        <label for="rbSurvey<?=$i?>" class="font-small"><?=$i?></label>
                        <input type="radio" class="rbSurvey font-small" name="rbSurvey" id="rbSurvey<?=$i?>" value="<?=$i?>"/>
                    </div>
                    <?php
                        endfor;
                    ?>
                </div>
                <button id="btnSubmitSurvey" class="font-small btnPrimary">Submit</button>
            </form>
            <?php
                else:
            ?>
            <span class="font-small bold">Thank you for completing our survey!</span>
            <button id="btnSurveyResults" class="btnPrimary font-small">Results</button>
            <?php
                endif;
            ?>
        </div>
        <button id="btnCloseSurveyBar" class="font-medium"><i class="fas fa-times"></i></button>
    </div>
<?php
        endif;
    endif;
?>