@extends('../manager.layout.side-menu')

@section('subcontent')
    @if (\Session::has('success'))
        <div class="rounded-md flex items-center px-5 py-4 mb-2 mt-2 bg-theme-18 text-theme-9">
            <i data-feather="alert-triangle" class="w-6 h-6 mr-2"></i> {!! \Session::get('success') !!}
        </div>
    @endif
    <div class="intro-y flex items-center mt-8">
        <h2 class="text-lg font-medium mr-auto">{{ $page_title }}</h2>
    </div>
    <div class="grid grid-cols-12 gap-6 mt-5">
        <div class="intro-y col-span-12 lg:col-span-6">
            <form class="validate-form-teacher" action="{{ route('manager-hicheel-save') }}" method="post" enctype="multipart/form-data">
                @csrf
                <!-- BEGIN: Анги нэмэх -->
                <div class="intro-y box p-5">
                    <div class="input-form">
                        <label class="flex flex-col sm:flex-row">
                        Хичээлийн нэр: <span class="sm:ml-auto mt-1 sm:mt-0 text-xs text-gray-600">Криллээр бичнэ</span>
                        </label>
                        <input type="text" name="ner" placeholder="Компьютерийн үндэс" class="input w-full border mt-2" minlength="2" required data-pristine-minlength-message="2 тэмдэгдээс дээш байх ёстой" data-pristine-required-message="Хичээлийн нэр хоосон байж болохгүй"/>
                    </div>
                    <div class="input-form" class="mt-3">
                        <label class="flex flex-col sm:flex-row">
                        Багш: 
                        </label>
                        <div class="mt-2">
                            <select name="b_id" data-search="true" class="tail-select w-full">
                                <option value="1">Тэнхим 1</option>
                                <option value="2">Тэнхим 2</option>
                                <option value="3">Тэнхим 3</option>
                            </select>
                        </div>
                    </div>
                    <div class="input-form" class="mt-3">
                        <div class="sm:grid grid-cols-3 gap-2">
                            <div class="relative mt-2">
                                <div class="absolute top-0 left-0 rounded-l px-4 h-full flex items-center justify-center bg-gray-100 dark:bg-dark-1 dark:border-dark-4 border text-gray-600">Цаг</div>
                                <div class="pl-6">
                                    <input type="text" name="tsag" class="input pl-12 w-full border col-span-4" minlength="1" maxlength="3" required data-pristine-integer-message="Тоо оруулна уу" data-pristine-minlength-message="1 тэмдэгт байх ёстой" data-pristine-maxlength-message="3 тэмдэгт байх ёстой" data-pristine-required-message="Цаг хоосон байж болохгүй">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="window.location.href='{{ route('manager-hicheel') }}'" class="button w-40 bg-theme-6 text-white ml-5">{{ __('site.cancel') }}</button> 
                        <button type="submit" name="action" value="save_and_new" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save_and_new') }}</button> 
                        <button type="submit" name="action" value="save" class="button w-40 bg-theme-1 text-white ml-5">{{ __('site.save') }}</button>
                    </div>
                </div>
                <!-- END: Анги нэмэх -->
            </div>
        </form>
    </div> 
@endsection

@section('style')
@endsection

@section('script')
@endsection