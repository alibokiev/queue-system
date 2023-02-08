@extends('admin.layout.master')

@section('title', 'Логин')

@section('content')
	<div class="container" id="app">
	    <div class="row align-items-center justify-content-center auth">
	        <div class="col-md-6 col-lg-5">
				<div class="card">
					<div class="card-block">
						<auth-form
								:action="'{{ url('/admin/login') }}'"
								:data="{}"
								inline-template>
							<form class="form-horizontal" role="form" method="POST" action="{{ url('/admin/login') }}" novalidate>
								{{ csrf_field() }}
								<div class="auth-header">
									<h1 class="auth-title">ЛОГИН</h1>
									<p class="auth-subtitle">Войти в систему под своими учетными данными</p>
								</div>
								<div class="auth-body">
									@include('admin.auth.includes.messages')
									<div class="form-group" :class="{'has-danger': errors.has('email'), 'has-success': this.fields.email && this.fields.email.valid }">
										<label for="email">Ваш EMail</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--mail"></i></div>
											<input type="text" v-model="form.email" v-validate="'required|email'" class="form-control" :class="{'form-control-danger': errors.has('email'), 'form-control-success': this.fields.email && this.fields.email.valid}" id="email" name="email" placeholder="ваш email">
										</div>
										<div v-if="errors.has('email')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('email') }}</div>
									</div>

									<div class="form-group" :class="{'has-danger': errors.has('password'), 'has-success': this.fields.password && this.fields.password.valid }">
										<label for="password">Ваш пароль</label>
										<div class="input-group input-group--custom">
											<div class="input-group-addon"><i class="input-icon input-icon--lock"></i></div>
											<input type="password" v-model="form.password"  class="form-control" :class="{'form-control-danger': errors.has('password'), 'form-control-success': this.fields.password && this.fields.password.valid}" id="password" name="password" placeholder="пароль">
										</div>
										<div v-if="errors.has('password')" class="form-control-feedback form-text" v-cloak>@{{ errors.first('password') }}</div>
									</div>

									<div class="form-group">
										<input type="hidden" name="remember" value="1">
										<button type="submit" class="btn btn-primary btn-block btn-spinner"><i class="fa"></i>
											Вход
										</button>
									</div>
									{{--<div class="form-group text-center">--}}
										{{--<a href="{{ url('/admin/password-reset') }}" class="auth-ghost-link">--}}
											{{--Забыли пароль?--}}
										{{--</a>--}}
									{{--</div>--}}
								</div>
							</form>
						</auth-form>
					</div>
				</div>
	        </div>
	    </div>
	</div>
   
@endsection


@section('bottom-scripts')
<script type="text/javascript">
    // fix chrome password autofill
    // https://github.com/vuejs/vue/issues/1331
    document.getElementById('password').dispatchEvent(new Event('input'));
</script>
@endsection