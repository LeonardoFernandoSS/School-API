<p>Dear {{ $user->name }},</p>

<p>
    We have received your request to reset your password on our platform. To assist you in regaining access to your account, please follow the instructions below:
</p>
<ol>
    <li>Click on the following link to initiate the password reset process: [Insert recovery link here]</li>
    <li>Upon accessing the link, you will be prompted to enter the following recovery token: {{ $user->token }}. Please ensure to copy the token exactly as provided, without any leading or trailing spaces.</li>
    <li>After entering the token, you will be directed to a page where you can set a new password for your account. Be sure to choose a strong and unique password to ensure the security of your account.</li>
</ol>
<p>
    If you did not request the password reset, please disregard this email. If you continue to receive such messages without request, please contact us immediately so we can investigate.
</p>
<p>
    If you need further assistance or have any questions, please do not hesitate to contact us. We are here to help.
</p>
<p>Best regards,</p>
<p>{{ config('app.name') }}</p>