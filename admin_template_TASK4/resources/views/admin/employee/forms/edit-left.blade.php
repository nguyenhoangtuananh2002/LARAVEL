<div class="col-12 col-md-9">
    <div class="card">
        <div class="row card-body">
            <!-- username -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('username'):</label>
                    <x-input name="username" :value="$employee->username" :required="true" :placeholder="__('username')" />
                </div>
            </div>
            <!-- email -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('email'):</label>
                    <x-input-email name="email" :value="$employee->email" :required="true" />
                </div>
            </div>

            <!-- new password -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('password'):</label>
                    <x-input-password name="password" />
                </div>
            </div>
            <!-- new password confirmation-->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('passwordConfirm'):</label>
                    <x-input-password name="password_confirmation"
                                      data-parsley-equalto="input[name='password']"
                                      data-parsley-equalto-message="{{ __('Mật khẩu không khớp.') }}" />
                </div>
            </div>
            <!-- gender -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('gender'):</label>
                    <x-select name="gender" :required="true">
                        @foreach ($gender as $key => $value)
                            <x-select-option :option="$employee->gender->value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>
            <!-- role -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('role'):</label>
                    <x-select name="role" :required="true">
                        @foreach ($role as $key => $value)
                            <x-select-option :option="$value" :value="$key" :title="__($value)" />
                        @endforeach
                    </x-select>
                </div>
            </div>

            <!-- birthday -->
            <div class="col-md-6 col-12">
                <div class="mb-3">
                    <label class="control-label">@lang('birthday'):</label>
                    <x-input type="date" name="birthday" :value="format_date($employee->birthday, 'Y-m-d')" :required="true" />
                </div>
            </div>
        </div>
    </div>
</div>
