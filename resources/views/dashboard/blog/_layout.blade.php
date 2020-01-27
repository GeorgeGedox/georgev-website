@extends('dashboard.layouts.app')

@push('css')
    <style>
        #markdown-preview{
            font-size: 1rem;
            line-height: 1.5;
            display: block;
            width: 100%;
            padding: .625rem .75rem;
            color: #8898aa;
            border-radius: .375rem;
            background-color: #fff;
            background-clip: padding-box;
            overflow: auto;
            transition: box-shadow .15s ease;
            border: 0;
            box-shadow: 0 1px 3px rgba(50, 50, 93, .15), 0 1px 0 rgba(0, 0, 0, .02);
        }

        #markdown-preview pre {
            background: #eee;
            padding: 10px;
        }

        #markdown-preview pre code{
            padding: 0;
            font-size: inherit;
            color: inherit;
            white-space: pre-wrap;
            background-color: transparent;
            border-radius: 0;
        }

        #markdown-preview code {
            color: #c7254e;
            background-color: #f9f2f4;
        }

        #markdown-preview blockquote {
            padding-left: 15px;
            border-left: 3px solid #eee;
        }

        #markdown-preview table {
            width: 100%;
            border: 1px solid #ccc;
            margin-bottom: 20px;
        }

        #markdown-preview table thead tr {
            background: #fff !important;
        }

        #markdown-preview table thead tr th {
            font-weight: 700;
            border-bottom: 2px solid #ccc;
            border-right: 1px solid #ccc;
            padding: 8px 10px;
        }

        #markdown-preview table thead tr th:last-child {
            border-right: 0;
        }

        #markdown-preview table tr td {
            font-weight: normal;
            border-bottom: 1px solid #ccc;
            border-right: 1px solid #ccc;
            padding: 8px 10px;
        }

        #markdown-preview table tr td:last-child {
            border-right: 0;
        }

        #markdown-preview table tr:nth-child(2n+1) {
            background: #f5f5f5;
        }
    </style>
@endpush

@push('js')
    <script src="{{ asset('argon') }}/vendor/showdownjs/dist/showdown.min.js"></script>
    <script>
        window.onload = function () {
            var converter = new showdown.Converter({
                tables: true
            })
            var pad = document.getElementById('markdown-input')
            var markdownArea = document.getElementById('markdown-preview')

            var convertTextAreaToMarkdown = function () {
                var markdownText = pad.value
                html = converter.makeHtml(markdownText)
                markdownArea.innerHTML = html
            }

            pad.addEventListener('input', convertTextAreaToMarkdown)

            convertTextAreaToMarkdown()
        }
    </script>
@endpush