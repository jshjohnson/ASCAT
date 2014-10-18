					<?php
					global $post, $user_ID, $user_identity, $comment_author, $comment_author_email;
					if( 'open' == $post->comment_status ): ?>
					<div id="respond">
						<?php if ( get_option( 'comment_registration' ) && ! $user_ID ) : ?>
						<srrong class="flash info login-required">
							You must be <a href="<?php echo get_option( 'siteurl' ); ?>/wp-login.php?redirect_to=<?php echo urlencode( get_permalink() ); ?>">logged in</a> to post a comment
						</strong>
						<?php else: ?>
						<form action="<?php echo site_url( '/wp-comments-post.php' ); ?>" method="post">
							<fieldset class="legend">
								<?php if ( $user_ID ) : ?>
								<strong class="flash info logged-in">
									Logged in and posting as <?php echo $user_identity; ?> &mdash; <a href="<?php echo wp_logout_url( get_permalink() ); ?>">Log out</a>
								</strong>
								<ol>
								<?php else: ?>
								<ol>
									<li>
										<label for="author">Name</label><br />
										<input type="text" name="author" id="author" maxlength="60" value="<?php echo $comment_author; ?>" required="required" />
									</li>
									<li>
										<label for="email">Email address</label><br />
										<input type="email" name="email" id="email" maxlength="50" value="<?php echo $comment_author_email; ?>" required="required" />
									</li>
								<?php endif; // if logged in ?>
									<li>
										<label for="comment">Type your comment</label><br />
										<textarea name="comment" id="comment" rows="10" cols="50" required="required"></textarea>
									</li>
								</ol>
							</fieldset>
							<fieldset>
								<button type="submit" id="submit">
									Add comment
								</button>
								<span class="cancel-reply">
									<?php cancel_comment_reply_link( 'Cancel reply' ); ?>
								</span>
								<?php comment_id_fields(); ?>
								<?php do_action( 'comment_form', $post->ID ); ?>
							</fieldset>
						</form>
						<?php endif; // if comment registration ?>
					</div>
					<?php endif; // if comments open ?>
