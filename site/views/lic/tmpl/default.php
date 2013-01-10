<?php
defined('_JEXEC') or die('Direct access only');

JHTML::_('behavior.modal');
?>
<?php 
   $file = JPATH_COMPONENT. '/views/lic/tmpl/' . 'lic.txt';
   //echo $file;
   $fobj=fopen($file,"r");
   $text=fread($fobj, filesize($file));
   //echo("<h2><font color='blue'>Вывод текстового файла</font><h2>");
   echo("<br>");
   echo("<font size=4>");
   echo($text);
   echo("</font>");
   fclose($fobj);
?>   
   <br>
   <form class="form-validate" name="lic" id="lic"
      action="<?php echo JRoute::_('index.php'); ?>" method="post">
      <fieldset>
         <p align=center>Согласен с использованием персональных данных на сайте<input type="checkbox" name="checklic" id="checklic" value="1"/>
         <input type="hidden" name="option" value="com_tsj" />
         <input type="hidden" name="task" value="lic.submit" />
         <br><br>
         <input id="submit" name="submit" type="submit" value="Передать данные" /> <?php echo JHtml::_('form.token'); ?></p>
      </fieldset>
   </form>