# PHP Home Test

## Requirements
- PHP >= 8.0 and [Composer](https://getcomposer.org/) in whichever flavor (installed locally, mounted into a VM, via [Docker](https://docs.docker.com/install/), ...)


```sql
SELECT CAST(CONV(SUBSTRING(SHA1("http://google.de/hh"), 1, 16), 16, 10) AS UNSIGNED);
/* => 2506542203823828068 */
```
