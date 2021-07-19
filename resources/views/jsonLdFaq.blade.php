@php $i = 1;
$hasFaq=false;
$jsonLd='';
@endphp

@foreach($editorModule as $key=>$module)
    @if(ucfirst($module['type']=='faq'))


       @php $hasFaq = true ;@endphp


        @foreach ($module['content'] as $faq)

            @php
            $jsonLd.= PHP_EOL.'{"@type": "Question",';

                $jsonLd.=   '"name": "'.$faq['question'].'",';
                $jsonLd.= '"acceptedAnswer":
                    {
                        "@type": "Answer",
                        "text": "'.str_replace('"',"'",$faq['answer']) .'"
                    }
                }';
            @endphp


            @php $jsonLd.= ','; @endphp


        @endforeach

    @endif
@endforeach

@if($hasFaq)

@php $jsonLd ='
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@type": "FAQPage","mainEntity":
                    [


        '.trim($jsonLd,','). '     ]
     } </script>;';

         @endphp

{!! $jsonLd !!}

@endif


