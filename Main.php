<?php

function calculate_offset(int $offset, string $text): string {

    // Initialize object
    $calculateOffset = new calculateOffset($offset, $text);

    // Call with getters to respect the private scope
    return $calculateOffset->calculate_offset($calculateOffset->getOffset(), $calculateOffset->getText());
}

class CalculateOffset
{
    private int $offset;
    private string $text;

    public const CHARACTERS =
        'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

    public function __construct(int $offset, string $text)
    {
        $this->offset = $offset;
        $this->text = $text;
    }

    public function calculate_offset(int $offset, string $text): string
    {
        if($offset >= 0) {
            $str = "";
            // Loop to every char
            for($i = 0; $i < strlen($text); $i++) {
                // Get position of the char in the constant from text
                $position = strpos(self::CHARACTERS, $text[$i]);

                // If we found the char
                if(false !== $position) {
                    // Check if offset oversize the constant string length
                    if($position + $offset < strlen(self::CHARACTERS) - 1) {
                        $str .= self::CHARACTERS[$position + $offset ];
                    } else { // We're over the size, need to make some computations

                        // Compute the length of character minus the position to get how much you still have
                        $next = strlen(self::CHARACTERS) - $position ;

                        // Get the char at offset and remove the next offset
                        $str .= self::CHARACTERS[$offset - $next];
                    }
                } else { // else the char doesn't exist into the constant string, so we don't modify the output
                    $str .= $text[$i];
                }
            }
        } else { // Offset is negative
            $str = "N/A";
        }

        return $str;
    }

    public function getOffset(): int
    {
        return $this->offset;
    }

    public function setOffset(int $offset): self
    {
        $this->offset = $offset;

        return $this;
    }

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $text): self
    {
        $this->text = $text;

        return $this;
    }
}

    /** Result parts */
    $result1 = calculate_offset(1, 'abc');

    echo "calculate_offset(1, 'abc');" . PHP_EOL;
    echo $result1 . PHP_EOL;

    $result2 = calculate_offset(-1, 'abc');

    echo "calculate_offset(-1, 'abc');" . PHP_EOL;
    echo $result2 . PHP_EOL;

    $result3 = calculate_offset(5, 'abc def.');

    echo "calculate_offset(5, 'abc def.');" . PHP_EOL;
    echo $result3 . PHP_EOL;

    $result4 = calculate_offset(4, 'abc def. Cc ZYXzzBc');
    echo "calculate_offset(4, 'abc def. Cc ZYXzzBc');" . PHP_EOL;
    echo $result4 . PHP_EOL;