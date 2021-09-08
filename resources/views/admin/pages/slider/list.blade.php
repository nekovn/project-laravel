@php
    use App\Helpers\Template as Template;
    $listTitle = Template::showTitleTable($controllerName);
@endphp
<div class="x_content">
    <div class="table-responsive">
        <table class="table table-striped jambo_table bulk_action">
            <thead>
            {!! $listTitle !!}
            </thead>
            <tbody>
            @if (count($items) >0)
                @foreach ($items as $key=>$val)
                    @php
                            $index           = $key+1;
                            $id              = $val->id;
                            $class           = ($index%2==0)?'even':'odd';
                            $name            = $val->name;
                            $description     = $val->description ;
                            $link            = $val->link;
                            $thumb           = Template::showItemThumb ($controllerName,$val->thumb,$val->name);
                            $status          = Template::showItemStatus ($controllerName,$id,$val->status);
                            $createHistory   = Template::showItemHistory ($val->created_by,$val->created);
                            $modifiedHistory = Template::showItemHistory ($val->modified_by,$val->modified);
                            $listBtnAction   = Template::showButtonAction ($controllerName,$id);


                    @endphp
                    <tr class="{{$class}} pointer">
                        <td class="">{{$index}}</td>
                        <td width="40%">
                            <p><strong>Name:</strong>{!! $name !!}</p>
                            <p><strong>Description:</strong>{!! $description !!}</p>
                            <p><strong>Link:</strong>{!! $link !!}</p>
                            <p>{!! $thumb !!}</p>
                        </td>

                        <td>{!! $status !!}</td>

                        <td>
                            {!! $createHistory !!}
                        </td>
                        <td>
                            {!! $modifiedHistory !!}
                        </td>
                        <td class="last">
                            {!! $listBtnAction  !!}
                        </td>
                    </tr>
                @endforeach

            @else
                @include('admin.templates.list_empty',['colspan'=>6])
            @endif
            </tbody>
        </table>
    </div>
</div>

