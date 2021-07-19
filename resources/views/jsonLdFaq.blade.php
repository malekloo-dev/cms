@php $i = 0 @endphp

@foreach($editorModule as $key=>$module)
    @if(ucfirst($module['type']=='faq'))
        @php
            $i = 1
        @endphp

        @if($i==1))

        <script type="application/ld+json">
                 @php $i = 2 @endphp
            {
                         "@context": "https://schema.org",
						  "@type": "FAQPage","mainEntity":
						  [
        @endif

        @foreach ($module['content'] as $key => $faq)

            {"@type": "Question",
              "name": "{!! $faq['question'] !!}",
              "acceptedAnswer":
              {
                "@type": "Answer",
                "text": "{!! $faq['answer'] !!}"
              }
            }

        @endforeach

    @endif
@endforeach

@if($i==2)
      ]
     }
  </script>

@endif





