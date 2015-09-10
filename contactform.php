<form method="post" class="contactform">
	<div class="input-group-lg">
		<input type="text" name="cf_name" class="form-control" value="<?= isset( $_POST["cf_name"] ) ? esc_attr( $_POST["cf_name"] ) : ''; ?>" placeholder="Ваше Имя" required>
	</div>
	<div class="input-group-lg">
		<input type="text" name="cf_phone" class="form-control" value="" placeholder="Ваш телефон" required>
	</div>
	<div class="comments">
		<textarea type="text" name="cf_message" rows="4" class="form-control" placeholder="Опишите Вашу проблему" required></textarea>
	</div>
	<div class="text-center">
		<input type="submit" value="Отправить" class="submit" name="cf_submit">
	</div>
</form>
<p>*Информация останется конфиденциальной</p>