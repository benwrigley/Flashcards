<x-email.layout :subject="$subject">

    <table>
        <tr>
            <td>
                <h1>{{ $subject}}</h1>
            </td>

        </tr>
        <tr>
            <td>
                Someone has requested a password reset for your Flashcards account. If this wasn't you, please ignore this email.
            </td>
        </tr>

        <tr>
            <td>
                <a
                target="_blank"
                rel="noopener noreferrer"
                href="{{ $reset_url }}"
                class="button button-primary"
                style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -webkit-text-size-adjust: none; border-radius: 4px; color: #fff; display: inline-block; overflow: hidden; text-decoration: none; background-color: #2d3748; border-bottom: 8px solid #2d3748; border-left: 18px solid #2d3748; border-right: 18px solid #2d3748; border-top: 8px solid #2d3748;"
                >
                    Reset Password
                </a>
            </td>
        </tr>
    </table>
</x-email.layout>
