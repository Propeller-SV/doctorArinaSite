<form method="post" id="contactform">
	<div class="input-group-lg">
		<input type="text" name="cf_name" class="form-control" value="<?= isset( $_POST["cf_name"] ) ? esc_attr( $_POST["cf_name"] ) : ''; ?>" placeholder="Ваше Имя" required>
	</div>
	<div class="input-group-lg">
		<input type="text" name="cf_phone" class="form-control" value="<?= isset( $_POST["cf_phone"] ) ? esc_attr( $_POST["cf_phone"] ) : ''; ?>" placeholder="Ваш телефон" required>
	</div>
	<div class="comments">
		<textarea type="text" name="cf_message" class="form-control" placeholder="Опишите Вашу проблему" required><?= isset( $_POST["cf_message"] ) ? esc_attr( $_POST["cf_message"] ) : ''; ?></textarea>
	</div>
	<input class="hidden" type="submit" name="cf_submit" id="cf_submit">
	<p class="text-center"><a href="javascript:{}" onclick="document.getElementById('cf_submit').click()">Отправить</a></p>
</form>
<p>*Информация останется конфиденциальной</p>