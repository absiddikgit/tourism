<div class="col-md-4 col-md-offset-4 search_bar">
    <div style="box-shadow:none; margin:0 0 40px 0" class="tabulation animate-box">
        
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="active">
                <a href="#flights" aria-controls="flights" role="tab" data-toggle="tab">Packages</a>
            </li>
        </ul>

        <!-- Tab panes -->
        <form class="" action="{!! route('frontend.packages.search') !!}" method="get">
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="packages">
                    <div class="row">
                        <div class="col-xxs-12 col-md-12 mt alternate">
                            <div class="input-field">
                                <label for="date-start">Package Type:</label>
                                <select name="type" class="form-control search_select">
                                    <option value="">Choose</option>
                                    @if ($package_types->count())
                                        @foreach ($package_types as $type)
                                            <option value="{{ $type->slug }}">{{ $type->type }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="col-xxs-12 col-xs-6 mt alternate">
                            <div class="input-field">
                                <label for="date-start">From:</label>
                                <input name="from" type="text" class="form-control" id="date-start" placeholder="mm/dd/yyyy"/>
                            </div>
                        </div>
                        <div class="col-xxs-12 col-xs-6 mt alternate">
                            <div class="input-field">
                                <label for="date-end">To:</label>
                                <input name="to" type="text" class="form-control" id="date-end" placeholder="mm/dd/yyyy"/>
                            </div>
                        </div>
                        <div id="app">
                            <div class="col-xxs-12 col-md-6 mt alternate">
                                <div class="input-field">
                                    <label for="date-start">Division:</label>
                                    {{-- <select id='division' name="division" class="form-control search_select" onchange="get_district_in_front(this.value);"> --}}
                                    <select id='division' name="division" class="form-control search_select" @change="get_district_in_front()" v-model="key">
                                        <option value="">Choose</option>
                                        @if ($divisions->count())
                                            @foreach ($divisions as $division)
                                                <option value="{{ $division->slug }}">{{ $division->name }}</option>
                                            @endforeach
                                        @endif
                                    </select>
                                </div>
                            </div>
                            <div class="col-xxs-12 col-md-6 mt alternate">
                                <div class="input-field">
                                    <label for="date-start">District:</label>
                                    <select name="district" class="form-control search_select" id="district" >
                                        <option value="">Choose</option>
                                        <option v-for="d in districts" :value="d.slug">@{{ d.name }}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-xs-12">
                            <input type="submit" class="btn btn-primary btn-block" value="Search Packages">
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>
