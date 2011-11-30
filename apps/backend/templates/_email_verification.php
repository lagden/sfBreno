<p>Olá <b><?php echo $user->fullname ?></b></p>
<p>
  Você esqueceu sua senha de acesso e solicitou uma nova.<br/>
  Para confirmar sua solicitação clique no link: <?php echo link_to($user->token_forgot, 'auth_forgot_verify', $user, array('absolute'=>true)) ?>
</p>
<p>
  Sua nova senha será encaminhada para o seu e-mail.<br/>
  Alguns bloqueios como firewal e anti-span pode fazer com que a mensagem seja postada na pasta de lixo eletrônico.
</p>
<p>
  Esta é uma mensagem eletrônica. Favor não responder.<br/>
  <b>Fibria - Portal de Sustentabilidade</b>
</p>
